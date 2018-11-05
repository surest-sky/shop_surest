<!DOCTYPE html>
<!--[if lt IE 9 ]> <html lang="en" dir="ltr" class="no-js ie-old"> <![endif]-->
<!--[if IE 9 ]> <html lang="en" dir="ltr" class="no-js ie9"> <![endif]-->
<!--[if IE 10 ]> <html lang="en" dir="ltr" class="no-js ie10"> <![endif]-->
<!--[if (gt IE 10)|!(IE)]><!-->
<html lang="en" dir="ltr" class="no-js">
<!--<![endif]-->

<head>

    <!-- ––––––––––––––––––––––––––––––––––––––––– -->
    <!-- META TAGS                                 -->
    <!-- ––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <!-- Always force latest IE rendering engine -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile specific meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- ––––––––––––––––––––––––––––––––––––––––– -->
    <!-- PAGE TITLE                                -->
    <!-- ––––––––––––––––––––––––––––––––––––––––– -->
    <title>{{ config('main.name') }} - @yield('title')</title>

    <!-- ––––––––––––––––––––––––––––––––––––––––– -->
    <!-- SEO METAS                                 -->
    <!-- ––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="description" content="FRIDAY is a responsive multipurpose-ecommerce site template allows you to store coupons and promo codes from different brands and create store for deals, discounts, It can be used as coupon website such as groupon.com and also as online store">
    <meta name="	black friday, coupon, coupon codes, coupon theme, coupons, deal news, deals, discounts, ecommerce, friday deals, groupon, promo codes, responsive, shop, store coupons">
    <meta name="robots" content="index, follow">
    <meta name="author" content="CODASTROID">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layout._css')

</head>

<body id="body" class="wide-layout preloader-active">



<!--[if lt IE 9]>
<p class="browserupgrade alert-error">
    You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
</p>
<![endif]-->

<noscript>
    <div class="noscript alert-error">
        For full functionality of this site it is necessary to enable JavaScript. Here are the <a href="http://www.enable-javascript.com/" target="_blank">
            instructions how to enable JavaScript in your web browser</a>.
    </div>
</noscript>

<!-- ––––––––––––––––––––––––––––––––––––––––– -->
<!-- PRELOADER                                 -->
<!-- ––––––––––––––––––––––––––––––––––––––––– -->
<!-- Preloader -->
<div id="preloader" class="preloader">
    <div class="loader-cube">
        <div class="loader-cube__item1 loader-cube__item"></div>
        <div class="loader-cube__item2 loader-cube__item"></div>
        <div class="loader-cube__item4 loader-cube__item"></div>
        <div class="loader-cube__item3 loader-cube__item"></div>
    </div>
</div>
<!-- End Preloader -->
<!-- ––––––––––––––––––––––––––––––––––––––––– -->
<!-- WRAPPER                                   -->
<!-- ––––––––––––––––––––––––––––––––––––––––– -->
<div id="pageWrapper" class="page-wrapper">
    <!-- –––––––––––––––[ HEADER ]––––––––––––––– -->
    @include('layout._header')
    <!-- –––––––––––––––[ HEADER ]––––––––––––––– -->

    <!-- –––––––––––––––[ PAGE CONTENT ]––––––––––––––– -->

    @yield('content')

    <!-- –––––––––––––––[ END PAGE CONTENT ]––––––––––––––– -->
    <section class="footer-top-area pt-70 pb-30 pos-r bg-blue">
        <div class="container">
            <div class="row row-tb-20">
                <div class="col-sm-12 col-md-7">
                    <div class="row row-tb-20">
                        <div class="footer-col col-sm-6">
                            <div class="footer-about">
                                <img class="mb-40" src="assets/images/logo_light.png" width="250" alt="">
                                <p class="color-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam dolores quidem mollitia id ipsa nisi necessitatibus iure repudiandae aperiam, odit ipsam dolor fugiat corporis nesciunt illo nemo minus.</p>
                            </div>
                        </div>
                        <div class="footer-col col-sm-6">
                            <div class="footer-top-twitter">
                                <h2 class="color-lighter">Twitter Feed</h2>
                                <ul class="twitter-list">
                                    <li class="single-twitter">
                                        <p class="color-light"><i class="ico fa fa-twitter"></i><a href="#">@masum_rana :</a> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore in reprehenderit.</p>
                                    </li>
                                    <li class="single-twitter">
                                        <p class="color-light"><i class="ico fa fa-twitter"></i><a href="#">@masum_rana :</a> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione id corrupti iusto cupiditate omnis.</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-5">
                    <div class="row row-tb-20">
                        <div class="footer-col col-sm-6">
                            <div class="footer-links">
                                <h2 class="color-lighter">Quick Links</h2>
                                <ul>
                                    <li><a href="deals_grid.html">Latest Deals</a>
                                    </li>
                                    <li><a href="coupons_grid.html">Newest Coupons</a>
                                    </li>
                                    <li><a href="contact_us_02.html">Contact Us</a>
                                    </li>
                                    <li><a href="404.html">Error 404</a>
                                    </li>
                                    <li><a href="terms_conditions.html">Terms of Use</a>
                                    </li>
                                    <li><a href="faq.html">FAQs</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-col col-sm-6">
                            <div class="footer-top-instagram instagram-widget">
                                <h2>Instagram Widget</h2>
                                <div class="row row-tb-5 row-rl-5">


                                    <div class="instagram-widget__item col-xs-4">
                                        <img src="assets/images/instagram/instagram_01.jpg" alt="">
                                    </div>


                                    <div class="instagram-widget__item col-xs-4">
                                        <img src="assets/images/instagram/instagram_02.jpg" alt="">
                                    </div>


                                    <div class="instagram-widget__item col-xs-4">
                                        <img src="assets/images/instagram/instagram_03.jpg" alt="">
                                    </div>


                                    <div class="instagram-widget__item col-xs-4">
                                        <img src="assets/images/instagram/instagram_04.jpg" alt="">
                                    </div>


                                    <div class="instagram-widget__item col-xs-4">
                                        <img src="assets/images/instagram/instagram_05.jpg" alt="">
                                    </div>


                                    <div class="instagram-widget__item col-xs-4">
                                        <img src="assets/images/instagram/instagram_06.jpg" alt="">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="payment-methods t-center">
                        <span><img src="assets/images/icons/payment/paypal.jpg" alt=""></span>
                        <span><img src="assets/images/icons/payment/visa.jpg" alt=""></span>
                        <span><img src="assets/images/icons/payment/mastercard.jpg" alt=""></span>
                        <span><img src="assets/images/icons/payment/discover.jpg" alt=""></span>
                        <span><img src="assets/images/icons/payment/american.jpg" alt=""></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- –––––––––––––––[ FOOTER ]––––––––––––––– -->
    <footer id="mainFooter" class="main-footer">
        <div class="container">
            <div class="row">
                <p>Copyright &copy; 2016 . All rights reserved.</p>
            </div>
        </div>
    </footer>
    <!-- –––––––––––––––[ END FOOTER ]––––––––––––––– -->

</div>
<!-- ––––––––––––––––––––––––––––––––––––––––– -->
<!-- END WRAPPER                               -->
<!-- ––––––––––––––––––––––––––––––––––––––––– -->


<!-- ––––––––––––––––––––––––––––––––––––––––– -->
<!-- BACK TO TOP                               -->
<!-- ––––––––––––––––––––––––––––––––––––––––– -->
<div id="backTop" class="back-top is-hidden-sm-down">
    <i class="fa fa-angle-up" aria-hidden="true"></i>
</div>

@include('layout._js')

@yield('script')
</body>

</html>