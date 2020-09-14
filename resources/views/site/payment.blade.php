@extends('site.layouts.book2')

@section('title', 'Trang thanh toán')

@section('content')
<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Danh mục sản phẩm</span>
                    </div>
                    <ul style="display: none">
                        @if($categories)
                            @foreach($categories as $category)
                                <li><a href="{{ url("/category/$category->id") }}">{{ $category->name }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form name="search" method="get" action="{{ url("/search") }}">
                            <input type="text" name="keyword" placeholder="Bạn muốn tìm gì ?">
                            <button type="submit" class="site-btn">TÌM KIẾM</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>Hỗ trợ 24/7 time</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" style="background: #7fad39">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Checkout</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ url("") }}">Home</a>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">

        <div class="checkout__form">
            <h4>Thông tin đơn hàng</h4>

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

            <form name="order" method="post" action="{{ url("/payment/checkout") }}">

                @csrf

                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Họ tên<span>*</span></p>
                                    <input type="text" name="customer_name">
                                </div>
                            </div>
                        </div>

                        <div class="checkout__input">
                            <p>Địa chỉ<span>*</span></p>
                            <input type="text" name="customer_address" placeholder="Street Address" class="checkout__input__add">
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>SDT<span>*</span></p>
                                    <input type="text" name="customer_phone">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" name="customer_email">
                                </div>
                            </div>
                        </div>

                        <div class="checkout__input">
                            <p>Ghi chút đơn hàng<span>*</span></p>
                            <input type="text" name="order_note"
                                   placeholder="Notes about your order, e.g. special notes for delivery.">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Đơn hàng của bạn</h4>
                            <div class="checkout__order__products">Products <span>Total</span></div>
                            <ul>
                                @php
                                    $total = 0;
                                @endphp
                                @if($products)
                                    @foreach($products as $product)
                                        @php $total += $cart[$product->id][0]['quantity'] * $product->product_price @endphp
                                        <li>{{ $product->product_name }} <span>${{ $cart[$product->id][0]['quantity'] * $product->product_price }}</span></li>
                                    @endforeach
                                @endif
                            </ul>
                            <div class="checkout__order__subtotal">Tổng tiền <span>$ {{ $total }}</span></div>
                            <div class="checkout__order__total">Thanh toán <span>$ {{ $total }}</span></div>

                            <button type="submit" class="site-btn">ĐẶT HÀNG</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

@endsection
