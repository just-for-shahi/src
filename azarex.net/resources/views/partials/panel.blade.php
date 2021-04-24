<!DOCTYPE html>
<html direction="rtl" dir="rtl" style="direction: rtl">
<head>
    <base href="">
    <meta charset="utf-8"/>
    <title>@yield('page.title') | {{config('app.name')}}</title>
    <meta name="description" content="پنل مشتریان صرافی آذر"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->

    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{asset('passets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css?v=7.0.6')}}" rel="stylesheet"
          type="text/css"/>
    <!--end::Page Vendors Styles-->


    <!--begin::Global تم Styles(used by all pages)-->
    <link href="{{asset('passets/plugins/global/plugins.bundle.rtl.css?v=7.0.6')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('passets/plugins/custom/prismjs/prismjs.bundle.rtl.css?v=7.0.6')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('passets/css/style.bundle.rtl.css?v=7.0.6')}}" rel="stylesheet" type="text/css"/>
    <!--end::Global تم Styles-->
    <link rel="shortcut icon" href="{{asset('passets/media/logos/favicon.ico')}}"/>

</head>
<!--end::Head-->

<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed page-loading">

<!--begin::Main-->
<!--begin::Header Mobile-->
<div id="kt_header_mobile" class="header-mobile bg-primary  header-mobile-fixed ">
    <!--begin::Logo-->
    <a href="{{route('panel.dashboard')}}">
        <img alt="Logo" src="{{asset('passets/media/logos/logo-letter-9.png')}}" class="max-h-30px"/>
    </a>
    <!--end::Logo-->

    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">

        <button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
            <span></span>
        </button>

        <button class="btn p-0 ml-2" id="kt_header_mobile_topbar_toggle">
			<span class="svg-icon svg-icon-xl"><!--begin::Svg Icon | path:assets/media/svg/icons/عمومی/User.svg--><svg
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path
            d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
            fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path
            d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
            fill="#000000" fill-rule="nonzero"/>
    </g>
</svg><!--end::Svg Icon--></span></button>
    </div>
    <!--end::Toolbar-->
</div>
<!--end::Header Mobile-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <!--begin::Header-->
            <div id="kt_header" class="header flex-column  header-fixed ">
                <!--begin::Top-->
                <div class="header-top">
                    <!--begin::Container-->
                    <div class=" container ">
                        <!--begin::راست-->
                        <div class="d-none d-lg-flex align-items-center mr-3">
                            <!--begin::Logo-->
                            <a href="{{route('panel.dashboard')}}" class="mr-20">
                                <img alt="Logo" src="{{asset('passets/media/logos/logo-letter-9.png')}}"
                                     class="max-h-35px"/>
                            </a>
                            <!--end::Logo-->

                            <!--begin::Tab ناوبری ها(for desktop mode)-->
                            <ul class="header-tabs nav align-self-end font-size-lg" role="tablist">
                                <!--begin::Item-->
                                <li class="nav-item">
                                    <a href="{{route('panel.dashboard')}}" class="nav-link py-4 px-6 @if(\Illuminate\Support\Facades\Route::currentRouteName() === 'panel.dashboard'
 or strpos(\Illuminate\Support\Facades\Route::currentRouteName(), 'panel.profile.') === 0
 or strpos(\Illuminate\Support\Facades\Route::currentRouteName(), 'panel.accounts.') === 0
 or strpos(\Illuminate\Support\Facades\Route::currentRouteName(), 'panel.tickets.') === 0
 or strpos(\Illuminate\Support\Facades\Route::currentRouteName(), 'panel.bankAccounts.') === 0) active @endif"
                                       data-toggle="tab" data-target="#kt_header_tab_1" role="tab">
                                        پیشخوان
                                    </a>
                                </li>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <li class="nav-item mr-3">
                                    <a href="#" class="nav-link py-4 px-6 @if(strpos(\Illuminate\Support\Facades\Route::currentRouteName(),'panel.exchanges.') === 0) active @endif" data-toggle="tab"
                                       data-target="#kt_header_tab_2" role="tab">
                                        ارزهای دیجیتال
                                    </a>
                                </li>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <li class="nav-item mr-3">
                                    <a href="#" class="nav-link py-4 px-6" data-toggle="tab"
                                       data-target="#kt_header_tab_3" role="tab">
                                        پرداخت‌های خارجی
                                    </a>
                                </li>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <li class="nav-item mr-3">
                                    <a href="#" class="nav-link py-4 px-6" data-toggle="tab"
                                       data-target="#kt_header_tab_4" role="tab">
                                        سرمایه گذاری
                                    </a>
                                </li>
                                <li class="nav-item mr-3">
                                    <a href="#" class="nav-link py-4 px-6" data-toggle="tab"
                                       data-target="#kt_header_tab_5" role="tab">
                                        درگاه پرداخت
                                    </a>
                                </li>
                                <li class="nav-item mr-3">
                                    <a href="#" class="nav-link py-4 px-6" data-toggle="tab"
                                       data-target="#kt_header_tab_6" role="tab">
                                        وام دهی
                                    </a>
                                </li>
                                <!--end::Item-->
                            </ul>
                            <!--begin::Tab ناوبری ها-->
                        </div>
                        <!--end::راست-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Top-->

                <!--begin::Bottom-->
                <div class="header-bottom">
                    <!--begin::Container-->
                    <div class=" container ">
                        <!--begin::Header Menu Wrapper-->
                        <div class="header-navs header-navs-left" id="kt_header_navs">
                            <!--begin::Tab ناوبری ها(for tablet and mobile modes)-->
                            <ul class="header-tabs p-5 p-lg-0 d-flex d-lg-none nav nav-bold nav-tabs" role="tablist">
                                <!--begin::Item-->
                                <li class="nav-item mr-2">
                                    <a href="#" class="nav-link btn btn-clean active" data-toggle="tab"
                                       data-target="#kt_header_tab_1" role="tab">
                                        خانه
                                    </a>
                                </li>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <li class="nav-item mr-2">
                                    <a href="#" class="nav-link btn btn-clean" data-toggle="tab"
                                       data-target="#kt_header_tab_2" role="tab">
                                        گزارشات
                                    </a>
                                </li>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <li class="nav-item mr-2">
                                    <a href="#" class="nav-link btn btn-clean" data-toggle="tab"
                                       data-target="#kt_header_tab_2" role="tab">
                                        سفارش
                                    </a>
                                </li>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <li class="nav-item mr-2">
                                    <a href="#" class="nav-link btn btn-clean" data-toggle="tab"
                                       data-target="#kt_header_tab_2" role="tab">
                                        مرکز راهنمایی
                                    </a>
                                </li>
                                <!--end::Item-->
                            </ul>
                            <!--begin::Tab ناوبری ها-->

                            <!--begin::Tab Content-->
                            <div class="tab-content">
                                <!--begin::Tab Pane-->
                                <div class="tab-pane py-5 p-lg-0 @if(\Illuminate\Support\Facades\Route::currentRouteName() === 'panel.dashboard'
 or strpos(\Illuminate\Support\Facades\Route::currentRouteName(), 'panel.profile.') === 0
 or strpos(\Illuminate\Support\Facades\Route::currentRouteName(), 'panel.accounts.') === 0
 or strpos(\Illuminate\Support\Facades\Route::currentRouteName(), 'panel.tickets.') === 0
 or strpos(\Illuminate\Support\Facades\Route::currentRouteName(), 'panel.bankAccounts.') === 0) active @endif" id="kt_header_tab_1">
                                    <!--begin::Menu-->
                                    <div id="kt_header_menu"
                                         class="header-menu header-menu-mobile  header-menu-layout-default ">
                                        <!--begin::Nav-->
                                        <ul class="menu-nav ">
                                            <li class="menu-item  @if(\Illuminate\Support\Facades\Route::currentRouteName() === 'panel.dashboard') menu-item-active @endif" aria-haspopup="true"><a
                                                    href="{{route('panel.dashboard')}}" class="menu-link "><span
                                                        class="menu-text">داشبورد</span></a></li>
                                            <li class="menu-item @if(strpos(\Illuminate\Support\Facades\Route::currentRouteName(),'panel.profile.') === 0) menu-item-active @endif"><a href="{{route('panel.profile.overview')}}" class="menu-link"><span
                                                        class="menu-text">حساب کاربری</span><span
                                                        class="menu-desc"></span></a>
                                            </li>
                                            <li class="menu-item @if(\Illuminate\Support\Facades\Route::currentRouteName() === 'panel.accounts.index') menu-item-active @endif"><a href="{{route('panel.accounts.index')}}" class="menu-link">
                                                    <span class="menu-text">حساب‌های مالی</span><span class="menu-desc"></span></a>
                                            </li>
                                            <li class="menu-item @if(\Illuminate\Support\Facades\Route::currentRouteName() === 'panel.tickets.index') menu-item-active @endif"><a href="{{route('panel.tickets.index')}}" class="menu-link">
                                                    <span class="menu-text">پشتیبانی</span><span class="menu-desc"></span></a>
                                            </li>
                                            <li class="menu-item @if(\Illuminate\Support\Facades\Route::currentRouteName() === 'panel.bankAccounts.index') menu-item-active @endif"><a href="{{route('panel.bankAccounts.index')}}" class="menu-link">
                                                    <span class="menu-text">حساب‌های بانکی</span><span class="menu-desc"></span></a>
                                            </li>
                                        </ul>
                                        <!--end::Nav-->
                                    </div>
                                    <!--end::Menu-->
                                </div>
                                <div class="tab-pane p-5 p-lg-0 justify-content-between @if(strpos(\Illuminate\Support\Facades\Route::currentRouteName(), 'panel.exchanges.') === 0) active @endif" id="kt_header_tab_2">
                                    <div id="kt_header_menu"
                                         class="header-menu header-menu-mobile  header-menu-layout-default ">
                                        <!--begin::Nav-->
                                        <ul class="menu-nav ">
                                            <li class="menu-item @if(\Illuminate\Support\Facades\Route::currentRouteName() === 'panel.exchanges.index') menu-item-active @endif">
                                                <a href="{{route('panel.exchanges.index')}}" class="menu-link"><span class="menu-text">خرید و فروش</span></a>
                                            </li>
                                            <li class="menu-item @if(\Illuminate\Support\Facades\Route::currentRouteName() === 'panel.exchanges.coins') menu-item-active @endif">
                                                <a href="{{route('panel.exchanges.coins')}}" class="menu-link"><span class="menu-text">قیمت زنده</span></a>
                                            </li>
                                        </ul>
                                        <!--end::Nav-->
                                    </div>
                                </div>
                                <div class="tab-pane p-5 p-lg-0 justify-content-between" id="kt_header_tab_3">
                                    <div id="kt_header_menu"
                                         class="header-menu header-menu-mobile  header-menu-layout-default ">
                                        <!--begin::Nav-->
                                        <ul class="menu-nav ">
                                            <li class="menu-item @if(\Illuminate\Support\Facades\Route::currentRouteName() === 'panel.payments.index') menu-item-active @endif">
                                                <a href="{{route('panel.payments.index')}}" class="menu-link"><span class="menu-text">سفارشات</span></a>
                                            </li>
                                        </ul>
                                        <!--end::Nav-->
                                    </div>
                                </div>
                                <div class="tab-pane p-5 p-lg-0 justify-content-between" id="kt_header_tab_4">
                                    <div id="kt_header_menu"
                                         class="header-menu header-menu-mobile  header-menu-layout-default ">
                                        <!--begin::Nav-->
                                        <ul class="menu-nav ">
                                            <li class="menu-item">
                                                <a href="https://azarsarmaye.com" target="_blank" class="menu-link"><span class="menu-text">آذرسرمایه</span></a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="https://manainvest.net" target="_blank" class="menu-link"><span class="menu-text">مانااینوست</span></a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="https://mfinance.app" target="_blank" class="menu-link"><span class="menu-text">MFinance</span></a>
                                            </li>
                                        </ul>
                                        <!--end::Nav-->
                                    </div>
                                </div>
                                <div class="tab-pane p-5 p-lg-0 justify-content-between" id="kt_header_tab_5">
                                    <div id="kt_header_menu"
                                         class="header-menu header-menu-mobile  header-menu-layout-default ">
                                        <!--begin::Nav-->
                                        <ul class="menu-nav ">
                                            <li class="menu-item @if(\Illuminate\Support\Facades\Route::currentRouteName() === 'panel.gateways.index') menu-item-active @endif">
                                                <a href="{{route('panel.gateways.index')}}" class="menu-link"><span class="menu-text">لیست درگاه‌ها</span></a>
                                            </li>
                                        </ul>
                                        <!--end::Nav-->
                                    </div>
                                </div>
                                <div class="tab-pane p-5 p-lg-0 justify-content-between" id="kt_header_tab_6">
                                    <div id="kt_header_menu"
                                         class="header-menu header-menu-mobile  header-menu-layout-default ">
                                        <!--begin::Nav-->
                                        <ul class="menu-nav ">
                                            <li class="menu-item @if(\Illuminate\Support\Facades\Route::currentRouteName() === 'panel.loans.index') menu-item-active @endif">
                                                <a href="{{route('panel.loans.index')}}" class="menu-link"><span class="menu-text">لیست وام‌ها</span></a>
                                            </li>
                                        </ul>
                                        <!--end::Nav-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Tab Content-->
                        </div>
                        <!--end::Header Menu Wrapper-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Bottom-->
            </div>
            <!--end::Header-->
        @yield('content')
            <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
                <div class="d-flex flex-column-fluid">
                    <div class=" container ">
                        <div class="row">
                            <div class="col-lg-6">
                                <!--begin::کال اوت-->
                                <div class="card card-custom mb-2 bg-diagonal bg-diagonal-light-primary">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between p-4">
                                            <!--begin::Content-->
                                            <div class="d-flex flex-column mr-5">
                                                <a href="#" class="h4 text-dark text-hover-primary mb-5">
                                                    پشتیبانان آنلاین پاسخگوی شما هستند!
                                                </a>
                                                <p class="text-dark-50">
                                                    در کمتر از ۱۰ دقیقه با پاسخ سوال هایتان برسید.<br>امتحان کنید
                                                </p>
                                            </div>
                                            <!--end::Content-->

                                            <!--begin::دکمه-->
                                            <div class="ml-6 flex-shrink-0">
                                                <a href="#" data-toggle="modal" data-target="#kt_chat_modal" class="btn font-weight-bolder text-uppercase font-size-lg btn-primary py-3 px-6">ارسال پیام</a>
                                            </div>
                                            <!--end::دکمه-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::کال اوت-->
                            </div>
                            <div class="col-lg-6">
                                <!--begin::کال اوت-->
                                <div class="card card-custom mb-2 bg-diagonal bg-diagonal-light-success">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between p-4">
                                            <!--begin::Content-->
                                            <div class="d-flex flex-column mr-5">
                                                <a href="{{route('pages.contact')}}" class="h4 text-dark text-hover-primary mb-5">
                                                    تلفنی تماس بگیرید
                                                </a>
                                                <p class="text-dark-50">
                                                    مشتاق صدای گرم تان هستیم!<br>تماس بگیرید.
                                                </p>
                                            </div>
                                            <!--end::Content-->

                                            <!--begin::دکمه-->
                                            <div class="ml-6 flex-shrink-0">
                                                <a href="{{route('pages.contact')}}" data-toggle="modal" data-target="#kt_chat_modal" class="btn font-weight-bolder text-uppercase font-size-lg btn-success py-3 px-6">تماس با ما</a>
                                            </div>
                                            <!--end::دکمه-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::کال اوت-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer bg-white py-4 d-flex flex-lg-column " id="kt_footer">
                <!--begin::Container-->
                <div class=" container  d-flex flex-column flex-md-row align-items-center justify-content-between">


                    <!--begin::کپی رایت-->
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted font-weight-bold mr-2">&copy; 1398-99 </span>
                        <a href="https://azarex.net" class="text-dark-75 text-hover-primary">تمامی حقوق برای صرافی آذر
                            محفوظ است.</a>
                    </div>
                    <!--end::کپی رایت-->

                    <!--begin::Nav-->
                    <div class="nav nav-dark order-1 order-md-2">
                        <a href="{{route('pages.about')}}" target="_blank" class="nav-link pr-3 pl-0">درباره ما</a>
                        <a href="{{route('pages.contact')}}" target="_blank" class="nav-link px-3">تماس با ما</a>
                        <a href="https://blog.azarex.net" target="_blank" class="nav-link pl-3 pr-0">وبلاگ</a>
                        <a href="https://docs.azarex.net" target="_blank" class="nav-link pl-3 pr-0">API Document</a>
                    </div>
                    <!--end::Nav-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Main-->



<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop">
	<span class="svg-icon"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg--><svg
            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
            viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1"/>
        <path
            d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
            fill="#000000" fill-rule="nonzero"/>
    </g>
</svg><!--end::Svg Icon--></span></div>
<!--end::Scrolltop-->


<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
<!--begin::Global Config(global config for global جی اس scripts)-->
<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1200
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#6993FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#F3F6F9",
                    "dark": "#212121"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1E9FF",
                    "secondary": "#ECF0F3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#212121",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#ECF0F3",
                "gray-300": "#E5EAEE",
                "gray-400": "#D6D6E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#80808F",
                "gray-700": "#464E5F",
                "gray-800": "#1B283F",
                "gray-900": "#212121"
            }
        },
        "font-family": "Poppins"
    };
</script>
<!--end::Global Config-->

<!--begin::Global تم Bundle(used by all pages)-->
<script src="{{asset('passets/plugins/global/plugins.bundle.js?v=7.0.6')}}"></script>
<script src="{{asset('passets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6')}}"></script>
<script src="{{asset('passets/js/scripts.bundle.js?v=7.0.6')}}"></script>
<!--end::Global تم Bundle-->

<!--begin::Page Vendors(used by this page)-->
<script src="{{asset('passets/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.6')}}"></script>
<!--end::Page Vendors-->

<!--begin::Page Scripts(used by this page)-->
<script src="{{asset('passets/js/pages/widgets.js?v=7.0.6')}}"></script>
</body>
</html>
