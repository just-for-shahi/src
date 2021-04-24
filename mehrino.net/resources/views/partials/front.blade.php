<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8"/>
    <meta name="description" content="description"/>
    <meta name="keywords" content="keywords"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}"/>
    <title>@yield('page.title') | {{config('app.name')}}</title>
    <link rel="stylesheet" href="{{asset('css/styles.min.css')}}"/>
    @stack('styles')
</head>
<body id="body">
<div class="page-wrapper">
    <div class="aside-dropdown">
        <div class="aside-dropdown__inner py-5"><span class="aside-dropdown__close">
					<svg class="icon">
						<use xlink:href="#close"></use>
					</svg></span>
            <div class="aside-dropdown__item d-lg-none d-block">
                <ul class="aside-menu">
                    @if (Route::currentRouteName() === 'index')
                        <li class="aside-menu__item aside-menu__item--has-child aside-menu__item--active">
                            <a class="anchor aside-menu__link" href="#body">
                                <span>خانه</span>
                            </a>
                        </li>
                        <li class="aside-menu__item aside-menu__item--has-child aside-menu__item--active">
                            <a class="anchor aside-menu__link" href="#about">
                                <span>درباره ما</span>
                            </a>
                        </li>
                        <li class="aside-menu__item aside-menu__item--has-child aside-menu__item--active">
                            <a class="anchor aside-menu__link" href="#footer-scroll">
                                <span>تماس با ما</span>
                            </a>
                        </li>
                        <li class="aside-menu__item aside-menu__item--has-child aside-menu__item--active">
                            <a class="anchor aside-menu__link" href="#download-app">
                                <span>دانلود اپلیکیشن</span>
                            </a>
                        </li>
                    @else
                        <li class="aside-menu__item aside-menu__item--has-child aside-menu__item--active">
                            <a class="aside-menu__link" href="{{ route('index') . '#body' }}">
                                <span>خانه</span>
                            </a>
                        </li>
                        <li class="aside-menu__item aside-menu__item--has-child aside-menu__item--active">
                            <a class="aside-menu__link" href="{{ route('index') . '#about' }}">
                                <span>درباره ما</span>
                            </a>
                        </li>
                        <li class="aside-menu__item aside-menu__item--has-child aside-menu__item--active">
                            <a class="aside-menu__link" href="{{ route('index') . '#footer-scroll' }}">
                                <span>تماس با ما</span>
                            </a>
                        </li>
                        <li class="aside-menu__item aside-menu__item--has-child aside-menu__item--active">
                            <a class="aside-menu__link" href="{{ route('index') . '#download-app' }}">
                                <span>دانلود اپلیکیشن</span>
                            </a>
                        </li>
                    @endif
{{--                    <li class="aside-menu__item aside-menu__item--has-child"><a class="aside-menu__link"--}}
{{--                                                                                href="javascript:void(0);"><span>صفحات</span></a>--}}
{{--                        <!-- sub menu start-->--}}
{{--                        <ul class="aside-menu__sub-list">--}}
{{--                            <li><a href="about.html"><span>About</span></a></li>--}}
{{--                            <li><a href="typography.html"> <span>Typography</span></a></li>--}}
{{--                            <li><a href="donors.html"><span>Donors & Partners</span></a></li>--}}
{{--                            <li><a href="volunteer.html"><span>Become a Volunteer</span></a></li>--}}
{{--                            <li><a href="events.html"><span>Events</span></a></li>--}}
{{--                            <li><a href="event-details.html"><span>Event Details</span></a></li>--}}
{{--                            <li><a href="stories.html"><span>Stories</span></a></li>--}}
{{--                            <li><a href="story-details.html"><span>Story Details</span></a></li>--}}
{{--                            <li><a href="blog.html"><span>Blog</span></a></li>--}}
{{--                            <li><a href="blog-post.html"><span>Blog Post</span></a></li>--}}
{{--                            <li><a href="gallery.html"><span>Gallery</span></a></li>--}}
{{--                            <li><a href="pricing.html"><span>Pricing Plans</span></a></li>--}}
{{--                            <li><a href="faq.html"><span>FAQ</span></a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="aside-menu__item aside-menu__item--has-child"><a class="aside-menu__link"--}}
{{--                                                                                href="javascript:void(0);"><span>کمک ها</span></a>--}}
{{--                        <ul class="aside-menu__sub-list">--}}
{{--                            <li><a href="causes.html"><span>Causes 1</span></a></li>--}}
{{--                            <li><a href="causes_2.html"> <span>Causes 2</span></a></li>--}}
{{--                            <li><a href="causes_3.html"><span>Causes 3</span></a></li>--}}
{{--                            <li><a href="cause-details.html"><span>Cause Details</span></a></li>--}}
{{--                        </ul>--}}
{{--                        <!-- sub menu end-->--}}
{{--                    </li>--}}
{{--                    <li class="aside-menu__item"><a class="aside-menu__link"--}}
{{--                                                    href="contacts.html"><span>تماس با ما</span></a></li>--}}
                </ul>
            </div>
            <div class="aside-dropdown__item">
                <!-- aside menu start-->
{{--                <ul class="aside-menu">--}}
{{--                    <li class="aside-menu__item"><a class="aside-menu__link" href="#">اسناد مدارک</a></li>--}}
{{--                    <li class="aside-menu__item"><a class="aside-menu__link" href="#">اطلاعات</a></li>--}}
{{--                    <li class="aside-menu__item"><a class="aside-menu__link" href="#">حامیان</a></li>--}}
{{--                    <li class="aside-menu__item"><a class="aside-menu__link" href="#">سازمانها</a></li>--}}
{{--                    <li class="aside-menu__item"><a class="aside-menu__link" href="#">همکاری</a></li>--}}
{{--                </ul>--}}
                <!-- aside menu end-->
                <div class="aside-inner"><span class="aside-inner__title">ایمیل</span><a class="aside-inner__link"
                                                                                         href="mailto:support@mehrino.com">support@mehrino.com</a>
                </div>
                <div class="aside-inner">
                    <span class="aside-inner__title">تلفن</span>
                    <a class="aside-inner__link" href="tel:02128422655">02128422655</a>
                </div>
                <ul class="aside-socials">
                    <li class="aside-socials__item"><a class="aside-socials__link" href="https://www.instagram.com/Mehrino.Official/"><i class="fa fa-instagram"
                                                                                               aria-hidden="true"></i></a>
                    </li>
{{--                    <li class="aside-socials__item"><a class="aside-socials__link" href="#"><i class="fa fa-google-plus"--}}
{{--                                                                                               aria-hidden="true"></i></a>--}}
{{--                    </li>--}}
{{--                    <li class="aside-socials__item"><a class="aside-socials__link aside-socials__link--active" href="#"><i--}}
{{--                                class="fa fa-twitter" aria-hidden="true"></i></a></li>--}}
{{--                    <li class="aside-socials__item"><a class="aside-socials__link" href="#"><i class="fa fa-facebook"--}}
{{--                                                                                               aria-hidden="true"></i></a>--}}
{{--                    </li>--}}
                </ul>
            </div>
            <div class="aside-dropdown__item">
                <a class="button button--squared" href="#">
                    <span>حمایت مستقیم</span>
                </a>
            </div>
        </div>
    </div>
    <header class="header header--front header--fixed">
        <div class="container-fluid">
            <div class="row no-gutters justify-content-between">
                <div class="col-auto d-flex align-items-center">
{{--                    <div class="dropdown-trigger d-none d-sm-block">--}}
{{--                        <div class="dropdown-trigger__item"></div>--}}
{{--                    </div>--}}
                    <div class="header-logo"><a class="header-logo__link" href="{{route('index')}}"><img
                                class="header-logo__img logo--light" src="{{asset('img/logo_white.png')}}" alt="logo"/><img
                                class="header-logo__img logo--dark" src="{{asset('img/logo_dark.png')}}" alt="logo"/></a></div>
                </div>
                <div class="col-auto">
                    <nav>
                        <ul class="main-menu">
                            @if (Route::currentRouteName() === 'index')
                                <li class="main-menu__item main-menu__item--active">
                                    <a class="anchor main-menu__link" href="#body">
                                        <span>خانه</span>
                                    </a>
                                </li>
                                <li class="main-menu__item main-menu__item--has-child">
                                    <a class="anchor main-menu__link" href="#about">
                                        <span>درباره ما</span>
                                    </a>
                                </li>
                                <li class="main-menu__item main-menu__item--has-child">
                                    <a class="anchor main-menu__link" href="#footer-scroll">
                                        <span>تماس با ما</span>
                                    </a>
                                </li>
                                <li class="main-menu__item main-menu__item--has-child">
                                    <a class="anchor main-menu__link" href="#download-app">
                                        <span>دانلود اپلیکیشن</span>
                                    </a>
                                </li>
                            @else
                                <li class="main-menu__item main-menu__item--has-child">
                                    <a class="main-menu__link" href="{{ route('index') . '#body' }}">
                                        <span>خانه</span>
                                    </a>
                                </li>
                                <li class="main-menu__item main-menu__item--has-child">
                                    <a class="anchor main-menu__link" href="{{ route('index') . '#about' }}">
                                        <span>درباره ما</span>
                                    </a>
                                </li>
                                <li class="main-menu__item main-menu__item--has-child">
                                    <a class="anchor main-menu__link" href="{{ route('index') . '#footer-scroll' }}">
                                        <span>تماس با ما</span>
                                    </a>
                                </li>
                                <li class="main-menu__item main-menu__item--has-child">
                                    <a class="main-menu__link" href="{{ route('index') . '#download-app' }}">
                                        <span>دانلود اپلیکیشن</span>
                                    </a>
                                </li>
                            @endif
{{--                            <li class="main-menu__item main-menu__item--has-child"><a class="main-menu__link"--}}
{{--                                                                                      href="javascript:void(0);"><span>صفحات</span></a>--}}
{{--                                <!-- sub menu start-->--}}
{{--                                <ul class="main-menu__sub-list sub-list--style-2">--}}
{{--                                    <li><a href="about.html"><span>About</span></a></li>--}}
{{--                                    <li><a href="typography.html"> <span>Typography</span></a></li>--}}
{{--                                    <li><a href="donors.html"><span>Donors & Partners</span></a></li>--}}
{{--                                    <li><a href="volunteer.html"><span>Become a Volunteer</span></a></li>--}}
{{--                                    <li><a href="team-member.html"><span>Team Member</span></a></li>--}}
{{--                                    <li><a href="events.html"><span>Events</span></a></li>--}}
{{--                                    <li><a href="event-details.html"><span>Event Details</span></a></li>--}}
{{--                                    <li><a href="stories.html"><span>Stories</span></a></li>--}}
{{--                                    <li><a href="story-details.html"><span>Story Details</span></a></li>--}}
{{--                                    <li><a href="blog.html"><span>Blog</span></a></li>--}}
{{--                                    <li><a href="blog-post.html"><span>Blog Post</span></a></li>--}}
{{--                                    <li><a href="gallery.html"><span>Gallery</span></a></li>--}}
{{--                                    <li><a href="pricing.html"><span>Pricing Plans</span></a></li>--}}
{{--                                    <li><a href="faq.html"><span>FAQ</span></a></li>--}}
{{--                                    <li><a href="404.html"><span>404 Page</span></a></li>--}}
{{--                                </ul>--}}
{{--                                <!-- sub menu end-->--}}
{{--                            </li>--}}
{{--                            <li class="main-menu__item main-menu__item--has-child"><a class="main-menu__link"--}}
{{--                                                                                      href="javascript:void(0);"><span>کمک ها</span></a>--}}
{{--                                <ul class="main-menu__sub-list">--}}
{{--                                    <li><a href="causes.html"><span>Causes 1</span></a></li>--}}
{{--                                    <li><a href="causes_2.html"> <span>Causes 2</span></a></li>--}}
{{--                                    <li><a href="causes_3.html"><span>Causes 3</span></a></li>--}}
{{--                                    <li><a href="cause-details.html"><span>Cause Details</span></a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li class="main-menu__item main-menu__item--has-child"><a class="main-menu__link" href="{{route('dashboard')}}"><span>حساب کاربری</span></a></li>--}}
                        </ul>
                    </nav>
                </div>
                <div class="col-auto d-flex align-items-center">
                    <!-- lang select start-->
{{--                    <ul class="lang-select">--}}
{{--                        <li class="lang-select__item lang-select__item--active"><span>فارسی</span>--}}
{{--                            <ul class="lang-select__sub-list">--}}
{{--                                <li><a href="#">english</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
                    <!-- lang select end-->
                    <div class="dropdown-trigger d-block d-lg-none">
                        <div class="dropdown-trigger__item"></div>
                    </div>
                    <a class="button button--squared d-none d-lg-flex" href="{{route('donate')}}">
                        <span>همراهی نقدی</span>
                    </a>
                </div>
            </div>
        </div>
    </header>
    @yield('wrapper')
    <footer class="footer" id="footer-scroll">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="footer-logo"><a class="footer-logo__link" href="{{route('index')}}"><img
                                class="footer-logo__img" src="{{asset('img/logo_white.png')}}" alt="logo"/></a></div>
                    <!-- footer socials start-->
                    <ul class="footer-socials">
                        <li class="footer-socials__item ml-3"><a class="footer-socials__link" href="#"><i
                                    class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li class="footer-socials__item ml-3"><a class="footer-socials__link" href="#"><i
                                    class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li class="footer-socials__item ml-3"><a class="footer-socials__link" href="#"><i
                                    class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        <li class="footer-socials__item ml-3"><a class="footer-socials__link" href="https://www.instagram.com/Mehrino.Official/"><i
                                    class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    </ul>
                    <!-- footer socials end-->
                </div>
                <div class="col-sm-6 col-lg-3">
                    <h4 class="footer__title">ارتباط با مهرینو</h4>
                    <div class="footer-contacts">
                        <p class="footer-contacts__address">تهران، چهارراه ولیعصر، ساختمان امیر کبیر، طبقه دوم</p>
                        <p class="footer-contacts__phone">تلفن: <a href="tel:02128422655">02128422655</a></p>
                        <p class="footer-contacts__mail">ایمیل: <a
                                href="mailto:support@mehrino.com">support@mehrino.com</a></p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <h4 class="footer__title">پیوند ها</h4>
                    <!-- footer nav start-->
                    <nav>
                        <ul class="footer-menu">
                            <li class="footer-menu__item footer-menu__item--active"><a class="footer-menu__link"
                                                                                       href="{{route('index')}}">خانه</a></li>
                            <li class="footer-menu__item"><a class="footer-menu__link" href="#">وبلاگ</a></li>
                            <li class="footer-menu__item"><a class="footer-menu__link" href="#">درباره ما</a>
                            </li>
                            <li class="footer-menu__item"><a class="footer-menu__link" href="#">تماس با ما</a></li>
                            <li class="footer-menu__item"><a class="footer-menu__link" href="#">صفحات</a></li>
                            <li class="footer-menu__item"><a class="footer-menu__link" href="#">کمک ها</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- footer nav end-->
                </div>
                <div class="col-sm-6 col-lg-3">
                    <h4 class="footer__title">کمک نقدی</h4>
                    <p>با کمک یکدیگر همه کار ممکنه</p><a class="button footer__button button--filled"
                                                         href="#">مهرینو</a>
                </div>
            </div>
            <div class="row align-items-baseline">
                <div class="col-md-6">
                    <p class="footer-copyright">© 2020 تمامی حقوق مطالب و تصاویر برای مهرینو محفوض است. ساخته شده با ❤
                        در تیم فنی مهرینو</p>
                </div>
                <div class="col-md-6">
                    <div class="footer-privacy"><a class="footer-privacy__link" href="#">سیاست حفظ حریم خصوصی</a><span
                            class="footer-privacy__divider">|</span><a class="footer-privacy__link" href="#">شرط و
                            شرایط</a></div>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="{{asset('js/libs.min.js')}}"></script>
<script src="{{asset('js/common.min.js')}}"></script>
@stack('scripts')
</body>
</html>
