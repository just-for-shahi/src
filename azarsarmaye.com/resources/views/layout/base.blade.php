<!DOCTYPE html>
<html lang="fa-IR">
<head>
    <meta charset="utf-8">
    <title>@yield('pageTitle') | آذرسرمایه - ضمانت هوشمند سرمایه</title>
    <meta name="description" content="آذرسرمایه | سرمایه گذاری آنلاین و هوشمند در بازارهای مالی">
    <meta name="keywords" content="آذرسرمایه,سرمایه گذاری,بورس,سهام,دلار,موفقیت">
    <meta name="author" content="AznaSoft">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon-16x16.png')}}">
    <link rel="mask-icon" color="#343b43">
    <meta name="msapplication-TileColor" content="#603cba">
    <meta name="theme-color" content="#603cba">
    <link rel="stylesheet" href="{{asset('css/vendor/feather.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/iziToast.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/noUISlider.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/socicon.css')}}">
    <link rel="stylesheet" media="screen" href="{{asset('css/theme.css')}}">
    <script src="{{asset('js/modernizr.min.js')}}"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-117500515-22"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-117500515-22');
    </script>
</head>
<body class="p-t-0">
<div class="wrapper">
    <div class="offcanvas-container is-triggered offcanvas-container-reverse" id="mobile-menu"><span class="offcanvas-close"><i class="fe-icon-x"></i></span>
        <div class="px-4 pb-4">
            <div class="d-table-cell align-middle pl-md-3"><a class="navbar-brand ml-1" href="{{route('index')}}"><img src="{{asset('img/logo2.png')}}" alt="آذرسرمایه"></a></div>
            <div class="d-flex justify-content-between pt-3">
                <a class="btn btn-primary btn-sm btn-block" href="{{route('login')}}"><i class="fe-icon-user"></i>&nbsp;شروع کنید</a>
            </div>
        </div>
        <div class="offcanvas-scrollable-area border-top">
            <!-- Mobile Menu-->
            <div class="accordion mobile-menu" id="accordion-menu">
                <!-- Home-->
                <div class="card">
                    <div class="card-header"><a class="mobile-menu-link active" href="#">خانه</a></div>

                </div>
                <div class="card">
                    <div class="card-header"><a class="mobile-menu-link" href="#">سرمایه گذاری</a></div>

                </div><div class="card">
                    <div class="card-header"><a class="mobile-menu-link" href="#">وبلاگ</a></div>

                </div><div class="card">
                    <div class="card-header"><a class="mobile-menu-link" href="#">تماس با ما</a></div>

                </div>
            </div>
        </div>
        <div class="offcanvas-footer px-4 pt-3 pb-2 text-center"><a class="social-btn sb-style-3 sb-twitter" href="#"><i class="socicon-twitter"></i></a><a class="social-btn sb-style-3 sb-facebook" href="#"><i class="socicon-facebook"></i></a><a class="social-btn sb-style-3 sb-instagram" href="#"><i class="socicon-instagram"></i></a></div>
    </div>
    <header class="navbar-wrapper navbar-floating navbar-floating navbar-sticky">
        <div class="container">
            <div class="d-table-cell align-middle pl-md-3"><a class="navbar-brand ml-1" href="{{route('index')}}"><img src="{{asset('img/logo_1.png')}}" alt="آذرسرمایه"></a></div>
            <div class="d-table-cell align-middle w-100 pl-md-3">
                <div class="navbar justify-content-end justify-content-lg-between">
                    <!-- Main Menu-->
                    <ul class="navbar-nav d-none d-lg-block">
                        <!-- Home-->
                        <li class="nav-item active"><a class="nav-link" href="{{route('index')}}">صفحه اصلی</a>

                        </li>
                        <!-- Portfolio-->
                        <li class="nav-item"><a class="nav-link" href="#">سرمایه گذاری</a>

                        </li>
                        <!-- Blog-->
                        <li class="nav-item"><a class="nav-link" href="#">وبلاگ</a>

                        </li>
                        <!-- Blog-->
                        <li class="nav-item"><a class="nav-link" href="#">تماس با ما</a>

                        </li>
                    </ul>
                    <div>
                        <ul class="navbar-buttons d-inline-block align-middle">
                            <li class="d-block d-lg-none"><a href="#mobile-menu" data-toggle="offcanvas"><i class="fe-icon-menu"></i></a></li>
                        </ul><a class="btn btn-gradient mr-3 d-none d-xl-inline-block" href="{{route('login')}}">ورود / ثبت نام</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('wrapper')

    <footer class="bg-dark pt-5">
        <div class="container pt-2">
            <div class="row">
                <div class="col-lg-3 pb-4 mb-2"><a class="navbar-brand d-inline-block mb-4" href="{{route('index')}}"><img src="{{asset('img/logo_1.png')}}" alt="CreateX"></a>
                    <p class="text-sm text-white opacity-50">آذرسرمایه اولین مرکز سرمایه گذاری در بازارهای مالی و ارزهای دیجیتال است. با توجه به تحریم های مالی ظالمانه و یکطرفه استکبار جهانی علیه کشور عزیزمان ایران، ما در آذرسرمایه با ضمانت هوشمند سرمایه شما بستری مستحکم و ایمن برای معاملات و سرمایه در ارزهای دیجیتال را فراهم کرده ایم.</p>
                    <ul class="list-icon text-sm pb-2">
                        <li><i class="fe-icon-map-pin text-white opacity-60"></i><a class="navi-link text-white" href="{{route('index')}}">تهران - برج فناوری امیرکبیر</a></li>
                        <li><i class="fe-icon-phone text-white opacity-60"></i><a class="navi-link text-white" href="tel:02100000000">021-22450000</a></li>
                        <li><i class="fe-icon-mail text-white opacity-60"></i><a class="navi-link text-white" href="mailto:info@azarsarmaye.com">
                                &nbsp;info@azarsarmaye.com</a></li>
                    </ul>
                    <a class="social-btn sb-style-6 sb-instagram sb-light-skin" href="#"><i class="socicon-instagram"></i></a>
                    <a class="social-btn sb-style-6 sb-facebook sb-light-skin" href="#"><i class="socicon-telegram"></i></a>
                    <a class="social-btn sb-style-6 sb-twitter sb-light-skin" href="#"><i class="socicon-twitter"></i></a>
                    <a class="social-btn sb-style-6 sb-youtube sb-light-skin" href="#"><i class="socicon-youtube"></i></a>
                </div>
                <div class="col-lg-6">
                    <div class="widget widget-light-skin mb-0">
                        <h4 class="widget-title">دسترسی سریع</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="widget widget-categories widget-light-skin">
                                <ul>
                                    <li><a href="#">درباره ما</a></li>
                                    <li><a href="#">داستان ما</a></li>
                                    <li><a href="#">خدمات و محصولات</a></li>
                                    <li><a href="https://azarsarmaye.com/blog/" target="_blank">وبلاگ</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="widget widget-categories widget-light-skin">
                                <ul>
                                    <li><a href="#">فرصت‌های شغلی</a></li>
                                    <li><a href="#">مرکز راهنمایی</a></li>
                                    <li><a href="#">مرکز طراحی</a></li>
                                    <li><a href="#">API Document</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget widget-light-skin">
                        <h4 class="widget-title">اپلیکیشن آذرسرمایه</h4>
                        <a class="market-btn apple-btn market-btn-light-skin ml-3 mb-3" href="#"><span class="mb-subtitle">Download on the</span><span class="mb-title">App Store</span></a>
                        <a class="market-btn google-btn market-btn-light-skin ml-3 mb-3" href="#"><span class="mb-subtitle">Download on the</span><span class="mb-title">Google Play</span></a>
                        {{--                        <a class="market-btn windows-btn market-btn-light-skin ml-3 mb-3" href="#"><span class="mb-subtitle">Download on the</span><span class="mb-title">Windows Store</span></a>--}}
{{--                        <script src="https://www.zarinpal.com/webservice/TrustCode" type="text/javascript"></script>--}}
{{--                        <a referrerpolicy="origin" target="_blank" href="https://trustseal.enamad.ir/?id=181543&amp;Code=phIX0z3QZNfFYALv5VfZ"><img referrerpolicy="origin" src="https://Trustseal.eNamad.ir/logo.aspx?id=181543&amp;Code=phIX0z3QZNfFYALv5VfZ" alt="" style="cursor:pointer" id="phIX0z3QZNfFYALv5VfZ"></a>--}}
                    </div>
                </div>
            </div>
            <hr class="hr-light">
            <div class="d-md-flex justify-content-between align-items-center py-4 text-center text-md-left">
                <div class="order-2">
                    <a class="footer-link text-white" href="{{route('about')}}">درباره ما</a>
                    <a class="footer-link text-white mr-3" href="#">قوانین و مقررات</a>
                    <a class="footer-link text-white mr-3" href="#">حریم خصوصی</a>
                </div>
                <p class="m-0 text-sm text-white order-1"><span class="opacity-60">همه حقوق محفوظ است.© ساخته شده با</span> <i class="d-inline-block align-middle fe-icon-heart text-danger"></i> <a href="{{route('index')}}" class="d-inline-block nav-link text-white opacity-60 p-0">در <strong>آذرسرمایه</strong></a></p>
            </div>

        </div>
        {{--        <div class="pt-5" style="background-color: #30363d;">--}}
        {{--            <div class="container">--}}
        {{--                <h6 class="text-white text-center">مشترک شدن در خبرنامه</h6>--}}
        {{--                <div class="row justify-content-center pb-5">--}}
        {{--                    <div class="col-xl-6 col-lg-7 col-md-9">--}}
        {{--                        <form action="" method="post" target="_blank" novalidate="">--}}
        {{--                            <div class="input-group">--}}
        {{--                                <input class="form-control form-control-light-skin text-left placeholder-right" type="email" name="EMAIL" placeholder="آدرس ایمیل">--}}
        {{--                                <div class="input-group-append">--}}
        {{--                                    <button class="btn btn-primary" type="submit">ثبت نام</button>--}}
        {{--                                </div>--}}
        {{--                            </div><small class="form-text text-white opacity-50 pt-1 text-center">برای دریافت آخرین بروز رسانی ها و محصولات جدید ایمیل خود را وارد نمایید.</small>--}}
        {{--                        </form>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </footer>
</div>
<!-- Back To Top Button--><a class="scroll-to-top-btn" href="#"><i class="fe-icon-chevron-up"></i></a>
<div class="site-backdrop"></div>
<script src="{{asset('js/vendor/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/vendor/popper.min.js')}}"></script>
<script src="{{asset('js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('js/vendor/imagesloaded.min.js')}}"></script>
<script src="{{asset('js/vendor/isotope.min.js')}}"></script>
<script src="{{asset('js/vendor/iziToast.min.js')}}"></script>
<script src="{{asset('js/vendor/jquery.animateNumber.min.js')}}"></script>
<script src="{{asset('js/vendor/jquery.countdown.min.js')}}"></script>
<script src="{{asset('js/vendor/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('js/vendor/nouislider.min.js')}}"></script>
<script src="{{asset('js/vendor/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/theme.js')}}"></script>
</body>
</html>
