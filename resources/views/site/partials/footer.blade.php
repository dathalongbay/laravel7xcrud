<!-- Footer Section Begin -->
<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="footer__about" style="text-align: center">
                    <div class="footer__about__logo">
                        <?php
                        $logo = str_replace("public/", "", $config['logo']);
                        ?>

                        <a href="{{ url("/") }}"><img src="{{ asset("storage/$logo") }}" alt=""></a>
                    </div>
                    <ul>
                        <li>Địa chỉ: 8 xã đàn đống đa HN</li>
                        <li>SDT: +65 11.188.888</li>
                        <li>Email: hello@fahasa.com</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__payment"><img src="{{ asset('fe-assets') }}/img/payment-item.png" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->
