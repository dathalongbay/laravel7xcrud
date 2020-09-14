<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> shop@book.com</li>
                            <li>Miễn phí giao hàng cho đơn từ 99.000 VND</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="header__logo">
                    <?php
                    $logo = str_replace("public/", "", $config['logo']);
                    ?>


                    <a href="{{ url("/") }}"><img src="{{ asset("storage/$logo") }}" alt=""></a>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li><a href="{{ url("/cart") }}"><i class="fa fa-shopping-bag"></i> <span>{{ $totalQttCart }}</span></a></li>
                    </ul>
                    <div class="header__cart__price">tổng: <span>$ {{ $totalPriceCart }}</span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->
