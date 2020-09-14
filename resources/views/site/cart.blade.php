@extends('site.layouts.book2')

@section('title', 'Trang giỏ hàng')

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
                    <h2>Shopping Cart</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ url("/") }}">Home</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
@php
$total = 0;
@endphp
<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                        <tr>
                            <th class="shoping__product">Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @if($products)
                            @foreach($products as $product)
                                @php
                                $product->product_image = str_replace("public/", "", $product->product_image);
                                @endphp
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="{{ asset("storage/$product->product_image") }}" style="width: 150px" alt="">
                                        <h5>{{ $product->product_name }}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        ${{ $product->product_price }}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" name="qttCart[]" class="qttCart" data-id="{{ $product->id }}" value="{{ $cart[$product->id][0]['quantity'] }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        ${{ $cart[$product->id][0]['quantity'] * $product->product_price }}
                                        @php
                                            $total += $cart[$product->id][0]['quantity'] * $product->product_price;
                                        @endphp
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close removeCart" data-id="{{ $product->id }}"></span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="{{ url("/") }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <li>Subtotal <span>$ {{ $total }}</span></li>
                        <li>Total <span>${{ $total }}</span></li>
                    </ul>
                    <a href="{{ url("/payment") }}" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->
@endsection

@section("appentjs")
    <script>

        $(document).ready(function () {


            $("body").on("click", ".qtybtn", function (e) {

                var input = $(this).closest(".pro-qty").find("input").eq(0);
                var id = input.data("id");
                id = parseInt(id);

                var qtt = input.val();
                qtt = parseInt(qtt);

                if (id > 0 && qtt > 0) {
                    $.ajax({
                        method: "POST",
                        url: "{{ url('/cart/update') }}",
                        data: { id: id,quantity: qtt,_token: "{{ csrf_token() }}" }
                    }).done(function( product ) {

                        location.reload();
                    });
                } else {
                    alert("có lỗi hệ thống vui lòng liên hệ admin");
                }
            });


            $(".qttCart").on("change", function (e) {

                alert(111);

                var id = $(this).data("id");
                id = parseInt(id);

                var qtt = $(this).val();
                qtt = parseInt(qtt);

                if (id > 0 && qtt > 0) {
                    $.ajax({
                        method: "POST",
                        url: "{{ url('/cart/update') }}",
                        data: { id: id,quantity: qtt,_token: "{{ csrf_token() }}" }
                    }).done(function( product ) {

                        location.reload();
                    });
                } else {
                    alert("có lỗi hệ thống vui lòng liên hệ admin");
                }
                console.log(id);
            });

            $(".removeCart").on("click", function (e) {
                e.preventDefault();

                var id = $(this).data("id");
                id = parseInt(id);

                if (id > 0) {
                    $.ajax({
                        method: "POST",
                        url: "{{ url('/cart/remove') }}",
                        data: { id: id,_token: "{{ csrf_token() }}" }
                    }).done(function( product ) {

                        location.reload();
                    });
                } else {
                    alert("có lỗi hệ thống vui lòng liên hệ admin");
                }
                console.log(id);
            });
        });
    </script>
@endsection
