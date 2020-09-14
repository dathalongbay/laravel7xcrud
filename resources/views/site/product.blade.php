@extends('site.layouts.book2')

@section('title', 'Trang chi tiết sản phẩm')

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
                    <h2>{{ $product->product_name }}</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ url("/") }}">Trang chủ</a>
                        <a href="{{ url("/category/$product->category->id") }}">{{ $product->category->name }}</a>
                        <span>{{ $product->product_name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <?php
                        $product->product_image = str_replace("public/", "", $product->product_image);
                        ?>
                        <img class="product__details__pic__item--large"
                             src="{{ asset("storage/$product->product_image") }}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{ $product->product_name }}</h3>

                    <div class="product__details__price">${{ $product->product_price }}</div>
                    <p>{!! $product->product_desc !!}</p>
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input name="quantity" type="text" value="1">
                            </div>
                        </div>
                    </div>
                    <a href="#" id="addtocart" data-id="{{ $product->id }}" class="primary-btn">THÊM VÀO GIỎ HÀNG</a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                               aria-selected="true">Description</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Products Infomation</h6>
                                <p>{!! $product->product_desc !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<div id="aftercart" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông báo giỏ hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Thêm sản phẩm vào giỏ hàng thành công! Vui lòng
                chọn hành động để tiếp tục</p>

                <a href="{{ url("/cart") }}" class="btn btn-success">Đến trang giỏ hàng</a>

                <a href="{{ url("/payment") }}" class="btn btn-info">Đến trang thanh toán</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tiếp tục mua sắm</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section("appentjs")
<script>

    $(document).ready(function () {

        $("#addtocart").on("click", function (e) {
            e.preventDefault();

            var id = $(this).data("id");
            id = parseInt(id);

            var quantity = $("input[name='quantity']").val();
            quantity = parseInt(quantity);


            if (id > 0) {
                $.ajax({
                    method: "POST",
                    url: "{{ url('/cart/add') }}",
                    data: { id: id,quantity: quantity,_token: "{{ csrf_token() }}" }
                }).done(function( product ) {

                    $('#aftercart').modal();
                });
            } else {
                alert("có lỗi hệ thống vui lòng liên hệ admin");
            }
            console.log(id);
        });
    });
</script>
@endsection
