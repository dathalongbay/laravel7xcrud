<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('fe-assets') }}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('fe-assets') }}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('fe-assets') }}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('fe-assets') }}/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('fe-assets') }}/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('fe-assets') }}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('fe-assets') }}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('fe-assets') }}/css/style.css" type="text/css">

    @yield("precss")

</head>

<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="https://cdn0.fahasa.com/skin/frontend/ma_vanese/fahasa/images/logo.png" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
        </ul>
        <div class="header__cart__price">tổng tiền: <span>$150.00</span></div>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> shop@book.com</li>
            <li>Miễn phí giao hàng cho đơn từ 99.000 VND</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

@yield("sidebarmobile")

@include("site.partials.header2")

@yield("content")

@include("site.partials.footer")

<!-- Js Plugins -->
<script src="{{ asset('fe-assets') }}/js/jquery-3.3.1.min.js"></script>
<script src="{{ asset('fe-assets') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('fe-assets') }}/js/jquery.nice-select.min.js"></script>
<script src="{{ asset('fe-assets') }}/js/jquery-ui.min.js"></script>
<script src="{{ asset('fe-assets') }}/js/jquery.slicknav.js"></script>
<script src="{{ asset('fe-assets') }}/js/mixitup.min.js"></script>
<script src="{{ asset('fe-assets') }}/js/owl.carousel.min.js"></script>
<script src="{{ asset('fe-assets') }}/js/main.js"></script>

@yield("appentjs")

</body>

</html>
