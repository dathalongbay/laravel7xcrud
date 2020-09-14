@extends('backend.layouts.main')

@section('title', 'Xóa đơn hàng')

@section('content')
    <h1>Xóa đơn hàng</h1>

    <form name="product" action="{{ url("/backend/orders/destroy/$order->id") }}" method="post">

        @csrf

        <div class="form-group">
            <label for="product_name">ID đơn hàng:</label>
            <p>{{ $order->id }}</p>
        </div>

        <div class="form-group">
            <label for="product_name">Tên khách hàng:</label>
            <p>{{ $order->customer_name }}</p>
        </div>

        <button type="submit" class="btn btn-danger">Xác nhận xóa đơn hàng</button>
    </form>
@endsection
