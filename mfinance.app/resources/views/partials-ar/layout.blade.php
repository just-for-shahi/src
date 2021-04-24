<?php
$clanguage = '/ar';
$cfolder = '/pages';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MFinance - Online Wealth Management Platform</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,900|Mirza:400,700&amp;subset=arabic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Allura" rel="stylesheet">
    <!-- inject:css-->
    <link rel="stylesheet" href="{{asset('front/vendor_assets/css/bootstrap/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('front/vendor_assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('front/vendor_assets/css/brands.css')}}">
    <link rel="stylesheet" href="{{asset('front/vendor_assets/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/vendor_assets/css/fontello.css')}}">
    <link rel="stylesheet" href="{{asset('front/vendor_assets/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('front/vendor_assets/css/jquery.mb.YTPlayer.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/vendor_assets/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/vendor_assets/css/lnr-icon.css')}}">
    <link rel="stylesheet" href="{{asset('front/vendor_assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('front/vendor_assets/css/navigation.css')}}">
    <link rel="stylesheet" href="{{asset('front/vendor_assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/vendor_assets/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/vendor_assets/css/settings.css')}}">
    <link rel="stylesheet" href="{{asset('front/vendor_assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('front/vendor_assets/css/trumbowyg.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/style.css')}}">
    <!-- endinject -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('front/img/favicon.png')}}">
</head>

<body>
@yield('content')
<footer class="footer6 footer--light-gradient">
    <div class="footer__big">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="widget text_widget">
                        <img class="footer_logo" src="{{asset('front/img/logo.png')}}" alt="Uinvest">
                        <p>
                            <a href="tel:+123-4567890" class="tel">+123 4567890</a>
                            <a href="mailto:support@uinvest.io" class="mail">Support@mfinance.app</a>
                            <span class="address">Melbourne, Australia, 95 South Park Avenue</span>
                        </p>
                    </div>
                </div><!-- ends: .col-lg-3 -->
                <div class="col-lg-3 col-md-6 col-sm-6 d-flex justify-content-lg-center">
                    <div class="widget widget--links">
                        <h4 class="widget__title2">Company</h4>
                        <ul class="links">
                            <li><a href="{{ $cfolder.$clanguage.'/about' }}">About Us</a></li>
                            <li><a href="{{ $cfolder.$clanguage.'/contact' }}">Contacts Us</a></li>
                            <li><a href="#">Testimonials</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Our Team</a></li>
                            <li><a href="{{ $cfolder.$clanguage.'/terms' }}">Terms</a></li>
                            <li><a href="{{ $cfolder.$clanguage.'/privacy-policy' }}">Privacy Policy</a></li>
                        </ul>
                    </div><!-- ends: .widget -->
                </div><!-- ends: .col-lg-3 -->
                <div class="col-lg-3 col-md-6 col-sm-6 d-flex justify-content-lg-center">
                    <div class="widget widget--links">
                        <h4 class="widget__title2">Services</h4>
                        <ul class="links">
                            <li><a href="#">Investment</a></li>
                            <li><a href="#">Signals</a></li>
                            <li><a href="#">MAccounts</a></li>
                            <li><a href="#">Consultation</a></li>
                        </ul>
                    </div><!-- ends: .widget -->
                </div><!-- ends: .col-lg-3 -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="widget widget--links">
                        <h4 class="widget__title2">Useful Links</h4>
                        <ul class="links">
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Client Area</a></li>
                            <li><a href="#">Support</a></li>
                            <li><a href="{{ $cfolder.$clanguage.'/faq' }}">FAQ's</a></li>
                            <li><a href="#">Newsletter</a></li>
                            <li><a href="#">Events</a></li>
                        </ul>
                    </div><!-- ends: .widget -->
                </div><!-- ends: .col-lg-3 -->
            </div>
        </div>
    </div><!-- ends: footer__big -->
    <div class="footer__bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__bottom-content">
                        <p>&copy; 2018-2020 MFinance. All rights reserved.</p>
                        <div class="social-basic ">
                            <ul class="d-flex justify-content-end ">
                                <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                                <li><a href="#"><span class="fab fa-google-plus-g"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- ends: footer__small -->
</footer><!-- ends: footer -->
<div class="go_top">
    <span class="la la-angle-up"></span>
</div>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDduF2tLXicDEPDMAtC6-NLOekX0A5vlnY"></script>
<!-- inject:js-->
<script src="{{asset('front/vendor_assets/js/jquery/jquery-1.12.3.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/jquery/uikit.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/bootstrap/popper.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/revolution/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/revolution/jquery.themepunch.revolution.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/revolution/extensions/revolution.extension.actions.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/revolution/extensions/revolution.extension.carousel.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/revolution/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/revolution/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/revolution/extensions/revolution.extension.migration.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/revolution/extensions/revolution.extension.navigation.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/revolution/extensions/revolution.extension.parallax.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/revolution/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/revolution/extensions/revolution.extension.video.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/chart.bundle.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/dashboard.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/grid.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/jquery.barrating.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/jquery.camera.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/jquery.easing1.3.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/jquery.filterizr.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/jquery.mb.YTPlayer.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/parallax.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/select2.full.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/slick.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/tether.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/trumbowyg.min.js')}}"></script>
<script src="{{asset('front/vendor_assets/js/waypoints.min.js')}}"></script>
<script src="{{asset('front/theme_assets/js/main.js')}}"></script>
<script src="{{asset('front/theme_assets/js/map.js')}}"></script>
<script src="{{asset('front/theme_assets/js/revolution.slider.init.js')}}"></script>
</body>

</html>
