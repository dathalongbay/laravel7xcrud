@extends('backend.layouts.main')

@section('title', 'Tạo mới đơn hàng')

@section('content')
    <h1>Tạo mới đơn hàng</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form name="orders" action="{{ url("/backend/orders/store") }}" method="post" enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label for="customer_name">Tên khách hàng:</label>
            <input type="text" name="customer_name" class="form-control" id="customer_name" value="{{ old('customer_name', "") }}">
        </div>

        <div class="form-group">
            <label for="customer_email">Email:</label>
            <input type="text" name="customer_email" class="form-control" id="customer_email" value="{{ old('customer_email', "") }}">
        </div>

        <div class="form-group">
            <label for="customer_phone">Số điện thoại:</label>
            <input type="text" name="customer_phone" class="form-control" id="customer_phone" value="{{ old('customer_phone', "") }}">
        </div>


        <div class="form-group">
            <label for="order_status">Trạng thái đơn hàng:</label>
            <select name="order_status" class="form-control" style="width: 250px">
                <option value="1" {{ old('order_status', "") == 1 ? "selected" : "" }}>Đang chờ xác nhận</option>
                <option value="2" {{ old('order_status', "") == 2 ? "selected" : "" }}>Đã xác nhận</option>
                <option value="3" {{ old('order_status', "") == 3 ? "selected" : "" }}>Đang vận chuyển</option>
                <option value="4" {{ old('order_status', "") == 4 ? "selected" : "" }}>Hoàn tất</option>
                <option value="5" {{ old('order_status', "") == 5 ? "selected" : "" }}>Đơn hủy</option>
                <option value="6" {{ old('order_status', "") == 6 ? "selected" : "" }}>Đã hoàn tiền ( hủy đơn )</option>
            </select>
        </div>

        <div class="form-group">
            <label for="customer_address">Địa chỉ:</label>
            <textarea name="customer_address" class="form-control" rows="3" id="customer_address">{{ old('customer_address', "") }}</textarea>
        </div>

        <div class="form-group">
            <label for="search_product">Tìm kiếm sản phẩm để thêm vào trong đơn hàng mới:</label>
            <select name="search_product" id="search_product" class="form-control" style="width: 250px">
                <option value="">Search ...</option>
            </select>

            <a href="#" id="addtocart" class="btn btn-info" style="margin: 10px 0">Thêm sản phẩm này vào đơn hàng</a>
        </div>


        <div class="form-group">
            <label for="customer_phone">Sản phẩm trong đơn hàng:</label>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Id sản phẩm</th>
                    <th>ảnh đại diện</th>
                    <th>tên sản phẩm</th>
                    <th>số lượng</th>
                    <th>giá tiền</th>
                    <th>tổng giá</th>
                    <th>xóa</th>
                </tr>
                </thead>
                <tbody id="list-cart-product">

                </tbody>
            </table>

            <div style="font-weight: bold">Tổng tiền thanh toán: <strong id="payment-price">0</strong></div>
        </div>

        <div class="form-group">
            <label for="order_note">Ghi chú:</label>
            <textarea name="order_note" class="form-control" rows="3" id="order_note">{{ old('order_note', "") }}</textarea>
        </div>

        <button type="submit" class="btn btn-info">Thêm đơn hàng</button>

    </form>
@endsection


@section('appendjs')

    <link rel="stylesheet" href="{{ asset("/be-assets/js/select2/select2.min.css") }}" />

    <script src="{{ asset("/be-assets/js/select2/select2.full.min.js") }}"></script>
    <script>

        $(document).ready(function () {
            function updateCart() {

                var total = 0;
                $("input[name='product_quatity[]").each(function (index, value) {
                    console.log(index);
                    console.log(value);

                    var t = $(this);
                    var tr = t.closest("tr");

                    var quantity = t.val();
                    var price = tr.find("td.product_price").text();
                    price = parseFloat(price);

                    var tt = quantity*price;

                    console.log(quantity);
                    console.log(price);
                    console.log(tt);
                    tr.find("td.product_price_total").text(tt);
                    total += tt;
                });

                $("#payment-price").text(total);


            }

            $('#search_product').select2({
                placeholder: 'Tìm 1 sản phẩm',
                ajax: {
                    type:'POST',
                    data:function (params) {
                        query = {
                            search: params.term,
                            _token: "{{ csrf_token() }}"
                        };
                        return query;
                    },
                    url: "{{ url('/backend/orders/searchProduct') }}",
                        processResults: function (data) {
                        console.log(data);
                        return data;
                    }
                }
            });

            $("#addtocart").on("click", function (e) {
                e.preventDefault();

                var id = $('#search_product').val();
                id = parseInt(id);

                if (id > 0) {
                    $.ajax({
                        method: "POST",
                        url: "{{ url('/backend/orders/ajaxSingleProduct') }}",
                        data: { id: id,_token: "{{ csrf_token() }}" }
                    }).done(function( product ) {

                        console.log(product);
                        checkTr = $("tbody#list-cart-product").find("#tr-"+product.id).length;
                        checkTr = parseInt(checkTr);
                        if (product.id !== "undefined" && product.product_quantity > 0 && checkTr < 1) {
                            var html = '<tr id="tr-'+product.id+'">\n' +
                                '                        <td>\n' +
                                '                            \n' + product.id +
                            '                            <input type="hidden" name="product_ids[]" class="form-control" style="width: 150px" value="'+product.id+'">\n' +
                            '                        </td>\n' +
                            '                        <td><img src="'+product.product_image+'" style="width: 100px; height: auto;"> </td>\n' +
                            '                        <td>'+product.product_name+'</td>\n' +
                            '                        <td>\n' +
                            '                            <input type="number" name="product_quatity[]" class="form-control" style="width: 150px" value="1">\n' +
                            '                        </td>\n' +
                            '                        <td class="product_price">\n' +
                            product.product_price +
                            '\n' +
                            '                        </td>\n' +
                            '                        <td class="product_price_total">\n' +
                                product.product_price +
                                '                        </td>\n' +
                            '\n' +
                            '                        <td>\n' +
                            '                            <a href="#" class="btn btn-danger removeCart">Xóa</a>\n' +
                            '                        </td>\n' +
                            '                    </tr>';
                            $( "tbody#list-cart-product" ).append( html );

                            updateCart();
                        } else {
                            alert("thêm sản phẩm không thành công do đã có sp trong giỏ hàng hoặc lỗi hệ thống");
                        }

                    });
                } else {
                    alert("chọn sản phẩm trước khi thêm nó vào đơn hàng");
                }
                console.log(id);
            });

            $("body").on("click", "a.removeCart", function (e) {
                e.preventDefault();

                $(this).closest("tr").remove();

                updateCart();
            });

            $("body").on("change", "input[name='product_quatity[]']", function () {

                var quantity = $(this).val();
                quantity = parseInt(quantity);
                if (quantity > 0 && quantity < 100) {
                    updateCart();
                } else {
                    $(this).val(1);
                    alert("chỉ được mua số lượng (1 đến 99)/một sản phẩm");
                    updateCart();
                }

            });
        });
    </script>
@endsection
