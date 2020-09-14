@extends('backend.layouts.main')

@section('title', 'Danh sách đơn hàng')

@section('content')
    <h1>Danh sách đơn hàng</h1>


    <div style="padding: 10px; border: 1px solid #4e73df; margin-bottom: 10px">
        <form name="search_orders" method="get" action="{{ htmlspecialchars($_SERVER["REQUEST_URI"]) }}" class="form-inline">

            <input name="name" value="{{ $searchKeyword }}" class="form-control" style="width: 350px; margin-right: 20px" placeholder="Nhập tên khách hàng bạn muốn tìm kiếm ..." autocomplete="off">


            <select name="sort" class="form-control" style="width: 150px; margin-right: 20px">
                <option value="">Sắp xếp</option>
                <option value="name_asc" {{ $sort == "name_asc" ? " selected" : "" }}>Tên khách hàng tăng dần</option>
                <option value="name_desc" {{ $sort == "name_desc" ? " selected" : "" }}>Tên khách hàng giảm dần</option>
            </select>

            <div style="padding: 10px 0">
                <input type="submit" name="search" class="btn btn-success" value="Lọc kết quả">
            </div>

            <div style="padding: 10px 0">
                <a href="#" id="clear-search" class="btn btn-warning">Clear filter</a>
            </div>

            <input type="hidden" name="page" value="1">

        </form>
    </div>

    {{ $orders->links() }}

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div style="padding: 20px">
        <a href="{{ url("/backend/orders/create") }}" class="btn btn-info">Thêm đơn hàng</a>
    </div>



    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>Id đơn hàng</th>
            <th>tên khách hàng</th>
            <th>số điện thoại</th>
            <th>email</th>
            <th>trạng thái</th>
            <td>tổng số sản phẩm</td>
            <td>tổng tiền</td>
            <th>hành động</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Id đơn hàng</th>
            <th>tên khách hàng</th>
            <th>số điện thoại</th>
            <th>email</th>
            <th>trạng thái</th>
            <td>tổng số sản phẩm</td>
            <td>tổng tiền</td>
            <th>hành động</th>
        </tr>
        </tfoot>
        <tbody>

        @if(isset($orders) && !empty($orders))
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>

                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_phone }}</td>
                    <td>{{ $order->customer_email }}</td>

                    <td>{{ $order_status_defined[$order->order_status] }}</td>

                    <td>
                        {{ $order->total_product }}
                    </td>
                    <td>{{ $order->total_price }}</td>

                    <td>
                        <a href="{{ url("/backend/orders/edit/$order->id") }}" class="btn btn-warning">Sửa đơn hàng</a>
                        <a href="{{ url("/backend/orders/delete/$order->id") }}" class="btn btn-danger">Xóa đơn hàng</a>
                    </td>
                </tr>
            @endforeach
        @else
            Chưa có bản ghi nào trong bảng này
        @endif

        </tbody>
    </table>

    {{ $orders->links() }}
@endsection

@section('appendjs')

    <script type="text/javascript">

        $(document).ready(function () {
            $("#clear-search").on("click", function (e) {
                e.preventDefault();

                $("input[name='name']").val('');
                $("select[name='sort']").val('');

                $("form[name='search_orders']").trigger("submit");
            });

            $("a.page-link").on("click", function (e) {
                e.preventDefault();

                var rel = $(this).attr("rel");

                if (rel == "next") {
                    var page = $("body").find(".page-item.active > .page-link").eq(0).text();
                    console.log(" : " + page);
                    page = parseInt(page);
                    page += 1;
                } else if(rel == "prev") {
                    var page = $("body").find(".page-item.active > .page-link").eq(0).text();
                    console.log(page);
                    page = parseInt(page);
                    page -= 1;
                } else {
                    var page = $(this).text();
                }

                console.log(page);

                page = parseInt(page);

                $("input[name='page']").val(page);

                $("form[name='search_orders']").trigger("submit");
            });
        });
    </script>

@endsection
