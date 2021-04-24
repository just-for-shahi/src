<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <title>@yield('page.title') | {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="اولین صرافی آنلاین ایران" />
    <meta name="keywords" content="صرافی ارز دیجیتال,خرید بیت کوین,خرید اتریوم,پرداخت پی پال" />
    <!-- favicon -->
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">
    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons -->
    <link href="{{asset('css/materialdesignicons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Slider -->
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}"/>
    <!-- Main css -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/style-rtl.css')}}" rel="stylesheet" type="text/css" />

</head>

<body>
<!-- Loader -->
<div id="preloader">
    <div id="status">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
</div>
<!-- Loader -->

<!-- Navbar STart -->
<header id="topnav" class="defaultscroll sticky bg-white">
    <div class="container">
        <!-- Logo container-->
        <div>
            <a class="logo" href="{{route('index')}}">صرافی&nbsp;<span class="text-primary">آذر</span></a>
        </div>
        <div class="buy-button">
            @if(auth()->check())
                <a href="{{route('panel.dashboard')}}" class="btn btn-primary">پنل کاربری</a>
            @else
                <a href="{{route('auth.login')}}" class="btn btn-primary">ورود/ثبت نام</a>
            @endif
        </div><!--end login button-->
        <!-- End Logo container-->
        <div class="menu-extras">
            <div class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </div>
        </div>

        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">
                <li><a href="{{route('index')}}">صفحه نخست</a></li>
                <li class="has-submenu">
                    <a href="#coins">ارزهای دیجیتال</a><span class="menu-arrow"></span>
                    <ul class="submenu megamenu">
                        <li>
                            <ul>
                                <li><a href="">بیت کوین</a></li>
                                <li><a href="">اتریوم</a></li>
                                <li><a href="">لایت کوین</a></li>
                                <li><a href="">بیت کوین کش</a></li>
                                <li><a href="">اتریوم کلاسیک</a></li>
                                <li><a href="">بایننس کوین</a></li>
                                <li><a href="">تتر</a></li>
                                <li><a href="">دوج کوین</a></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><a href="">مونرو</a></li>
                                <li><a href="">دش</a></li>
                                <li><a href="">نئو</a></li>
                                <li><a href="">پیمان&nbsp;<span class="badge badge-danger rounded">ایرانی</span></a></li>
                                <li><a href="">زی کش</a></li>
                                <li><a href="">ریپل</a></li>
                                <li><a href="">ترون</a></li>
                                <li><a href="">آذر&nbsp;<span class="badge badge-success rounded"> جدید </span>&nbsp;
                                    <span class="badge badge-danger rounded">ایرانی</span> </a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="has-submenu">
                    <a href="javascript:void(0)">آموزش</a><span class="menu-arrow"></span>
                    <ul class="submenu">
                        <li><a href="">مفاهیم پایه</a></li>
                        <li><a href="">دانشنامه</a></li>
                        <li><a href="">تحلیل و سرمایه گذاری</a></li>
                        <li><a href="">قانون گذاری</a></li>
                        <li><a href="">نرم افزارها</a></li>
                        <li><a href="">پادکست ها</a></li>
                        <li><a href="">بررسی هفته</a></li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="javascript:void(0)">آشنایی بیشتر</a><span class="menu-arrow"></span>
                    <ul class="submenu">
                        <li><a href="{{route('pages.about')}}">درباره ما</a></li>
                        <li><a href="{{route('pages.contact')}}">تماس با ما</a></li>
                        <li><a href="{{route('pages.pricing')}}">کارمزدها</a></li>
                        <li><a href="{{route('pages.privacy')}}">حریم خصوصی</a></li>
                        <li><a href="{{route('pages.terms')}}">قوانین و مقررات</a></li>
                        <li><a href="{{route('pages.help.index')}}">مرکز راهنمایی</a></li>
                        <li><a href="https://docs.azarex.net">API Document</a></li>
                    </ul>
                </li>
            </ul><!--end navigation menu-->
            <div class="buy-menu-btn d-none">
                @if(auth()->check())
                    <a href="{{route('panel.dashboard')}}" class="btn btn-primary">پنل کاربری</a>
                @else
                    <a href="{{route('auth.login')}}" class="btn btn-primary">ورود/ثبت نام</a>
                @endif
            </div><!--end login button-->
        </div><!--end navigation-->
    </div><!--end container-->
</header><!--end header-->
<!-- Navbar End -->
@yield('wrapper')
<!-- Footer Start -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-12 mb-0 mb-md-4 pb-0 pb-md-2">
                <a class="logo-footer" href="https://azarex.net">صرافی&nbsp;<span class="text-primary">آذر</span></a>
                <p class="mt-4">با صرافی آذر به راحتی میتوانید ارز دیجیتال بخرید و بفروشید. ما در صرافی آذر بازارچه خرید و فروش بین کاربران ایجاد کردیم. امنیت، سرعت و سهولت سرلوحه کار ما در صرافی آذر هست.</p>
                <ul class="list-unstyled social-icon social mb-0 mt-4">
                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-facebook" title="فیس بوک"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-instagram" title="اینستاگرام"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-twitter" title="توییتر"></i></a></li>
                </ul><!--end icon-->
            </div><!--end col-->

            <div class="col-lg-2 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h4 class="text-light footer-head">آشنایی بیشتر</h4>
                <ul class="list-unstyled footer-list mt-4">
                    <li><a href="" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i>ارز دیجیتال چیست؟</a></li>
                    <li><a href="{{route('pages.about')}}" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> درباره ما</a></li>
                    <li><a href="{{route('pages.contact')}}" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> تماس با ما</a></li>
                    <li><a href="{{route('pages.pricing')}}" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> کارمزدها</a></li>
                    <li><a href="{{route('pages.privacy')}}" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> حریم خصوصی</a></li>
                    <li><a href="{{route('pages.terms')}}" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> قوانین و مقررات</a></li>
                    <li><a href="{{route('pages.help.index')}}" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> مرکز راهنمایی</a></li>
                    <li><a href="https://docs.azarex.net" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> API Document</a></li>
                </ul>
            </div><!--end col-->

            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h4 class="text-light footer-head">خدمات و محصولات</h4>
                <ul class="list-unstyled footer-list mt-4">
                    <li><a href="" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> تبادل ارزها</a></li>
                    <li><a href="" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i>توکن اختصاصی آذر</a></li>
                    <li><a href="" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i>درگاه پرداخت</a></li>
                    <li><a href="" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> وام دهی</a></li>
                    <li><a href="" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i>سرمایه گذاری</a></li>
                    <li><a href="" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i>سرویس پرداخت خارجی</a></li>
                    <li><a href="" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i>خیریه آذر</a></li>
                    <li><a href="" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i>تالار معاملات ارزی</a></li>
                </ul>
            </div><!--end col-->
            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h4 class="text-light footer-head">وبلاگ</h4>
                <ul class="list-unstyled footer-list mt-4">
                    <li><a href="" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> اخبار</a></li>
                    <li><a href="" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i>مفاهیم پایه</a></li>
                    <li><a href="" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i>دانشنامه</a></li>
                    <li><a href="" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> تحلیل و سرمایه گذاری</a></li>
                    <li><a href="" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i>قانون گذاری</a></li>
                    <li><a href="" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i>نرم افزارها</a></li>
                    <li><a href="" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i>پادکست ها</a></li>
                    <li><a href="" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i>بررسی هفته</a></li>
                </ul>
            </div><!--end col-->

        </div><!--end row-->
    </div><!--end container-->
</footer><!--end footer-->
<hr>
<footer class="footer footer-bar">
    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="text-sm-left">
                    <p class="mb-0">© 1398-99 تمامی حقوق برای «<strong>صرافی آذر</strong>» محفوظ است.</p>
                </div>
            </div>

            <div class="col-sm-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <ul class="list-unstyled payment-cards text-sm-right mb-0">
                    <li class="list-inline-item"><a href="javascript:void(0)"><img src="images/payments/american-ex.png" title="آمریکن اکسپرس" alt=""></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)"><img src="images/payments/discover.png" title="کشف کردن" alt=""></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)"><img src="images/payments/master-card.png" title="مستر کارد" alt=""></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)"><img src="images/payments/paypal.png" title="پی پال" alt=""></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)"><img src="images/payments/visa.png" title="ویزا" alt=""></a></li>
                </ul>
            </div>
        </div>
    </div><!--end container-->
</footer><!--end footer-->
<!-- Footer End -->

<!-- Back to top -->
<a href="#" class="back-to-top rounded text-center" id="back-to-top">
    <i class="mdi mdi-chevron-up d-block"> </i>
</a>
<!-- Back to top -->

<!-- javascript -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/scrollspy.min.js')}}"></script>
<!-- SLIDER -->
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/owl.init.js')}}"></script>
<!-- Counter -->
<script src="{{asset('js/counter.init.js')}}"></script>
<!-- Main Js -->
<script src="{{asset('js/app.js')}}"></script>
</body></html>
