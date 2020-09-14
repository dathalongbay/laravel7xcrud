@extends('backend.layouts.main')

@section('title', 'Cập nhật đơn hàng')

@section('content')
    <h1>Cập nhật đơn hàng</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form name="orders" action="{{ url("/backend/orders/update/$order->id") }}" method="post" enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label for="customer_name">Tên khách hàng:</label>
            <input type="text" name="customer_name" class="form-control" id="customer_name" value="{{ $order->customer_name }}">
        </div>

        <div class="form-group">
            <label for="customer_email">Email:</label>
            <input type="text" name="customer_email" class="form-control" id="customer_email" value="{{ $order->customer_email }}">
        </div>

        <div class="form-group">
            <label for="customer_phone">Số điện thoại:</label>
            <input type="text" name="customer_phone" class="form-control" id="customer_phone" value="{{ $order->customer_phone }}">
        </div>


        <div class="form-group">
            <label for="order_status">Trạng thái đơn hàng:</label>
            <select name="order_status" class="form-control" style="width: 250px">
                <option value="1" {{ $order->order_status == 1 ? "selected" : "" }}>Đang chờ xác nhận</option>
                <option value="2" {{ $order->order_status == 2 ? "selected" : "" }}>Đã xác nhận</option>
                <option value="3" {{ $order->order_status == 3 ? "selected" : "" }}>Đang vận chuyển</option>
                <option value="4" {{ $order->order_status == 4 ? "selected" : "" }}>Hoàn tất</option>
                <option value="5" {{ $order->order_status == 5 ? "selected" : "" }}>Đơn hủy</option>
                <option value="6" {{ $order->order_status == 6 ? "selected" : "" }}>Đã hoàn tiền ( hủy đơn )</option>
            </select>
        </div>

        <div class="form-group">
            <label for="customer_address">Địa chỉ:</label>
            <textarea name="customer_address" class="form-control" rows="3" id="customer_address">{{ $order->customer_address }}</textarea>
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
                </tr>
                </thead>
                <tbody id="list-cart-product">
                    @foreach($productInOrders as $productInOrder)
                        <tr id="tr-{{ $productInOrder->id }}">
                            <td> {{ $productInOrder->id }} </td>
                            <td>
                                @if ($productInOrder->product_image)
                                    <?php
                                    $productInOrder->product_image = str_replace("public/", "", $productInOrder->product_image);
                                    ?>

                                    <div>
                                        <img src="{{ asset("storage/$productInOrder->product_image") }}" style="width: 200px; height: auto" />
                                    </div>

                                @endif
                            </td>
                            <td>{{ $productInOrder->product_name }}</td>
                            <td>
                               {{ $productInOrder->quantity }}
                            </td>
                            <td class="product_price">
                                {{ $productInOrder->product_price }}
                            </td>
                            <td class="product_price_total">
                                {{ $productInOrder->product_price * $productInOrder->quantity }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="font-weight: bold">Tổng tiền thanh toán: <strong id="payment-price">{{ $order->total_price }}</strong></div>
        </div>

        <div class="form-group">
            <label for="order_note">Ghi chú:</label>
            <textarea name="order_note" class="form-control" rows="3" id="order_note">{{ $order->order_note }}</textarea>
        </div>



        <button type="submit" class="btn btn-info">Cập nhật đơn hàng</button>
    </form>
@endsection
