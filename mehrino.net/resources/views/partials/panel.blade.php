<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('page.title') | {{config('app.name')}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{asset('panel/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('panel/css/main-color.css')}}" id="colors">
    @stack('styles')
</head>

<body>
    <div id="wrapper">
        <header id="header-container" class="fixed fullwidth dashboard">
            <div id="header" class="not-sticky">
                <div class="container">
                    <div class="left-side">
                        <div id="logo">
                            <a href="{{route('dashboard')}}"><img src="{{asset('img/logo_white.png')}}" alt="logo"></a>
                            <a href="{{route('dashboard')}}" class="dashboard-logo"><img src="{{asset('img/logo_white.png')}}" alt="logo"></a>
                        </div>

                        <!-- Mobile Navigation -->
                        <div class="mmenu-trigger">
                            <button class="hamburger hamburger--collapse" type="button">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>

                        <!-- Main Navigation -->
                        <nav id="navigation" class="style-1">
                            <ul id="responsive">
                                <li><a href="{{ route('index') }}">صفحه اصلی</a>
                                    {{-- <ul>--}}
                                    {{-- <li><a href="index.html">صفحه اصلی 1</a></li>--}}
                                    {{-- <li><a href="index-2.html">صفحه اصلی 2</a></li>--}}
                                    {{-- <li><a href="index-3.html">صفحه اصلی 3</a></li>--}}
                                    {{-- <li><a href="index-4.html">صفحه اصلی 4</a></li>--}}
                                    {{-- <li><a href="index-5.html">صفحه اصلی 5</a></li>--}}
                                    {{-- </ul>--}}
                                </li>

                                {{-- <li><a href="#">آگهی ها</a>--}}
                                {{-- <ul>--}}
                                {{-- <li><a href="#">طرح آگهی</a>--}}
                                {{-- <ul>--}}
                                {{-- <li><a href="listings-list-with-sidebar.html">با نوار کناری</a></li>--}}
                                {{-- <li><a href="listings-list-full-width.html">تمام عرض</a></li>--}}
                                {{-- <li><a href="listings-list-full-width-with-map.html">عرض کامل + نقشه</a></li>--}}
                                {{-- </ul>--}}
                                {{-- </li>--}}
                                {{-- <li><a href="#">طرح شبکه</a>--}}
                                {{-- <ul>--}}
                                {{-- <li><a href="listings-grid-with-sidebar-1.html">با نوار کناری 1</a></li>--}}
                                {{-- <li><a href="listings-grid-with-sidebar-2.html">با نوار کناری 2</a></li>--}}
                                {{-- <li><a href="listings-grid-full-width.html">تمام عرض</a></li>--}}
                                {{-- <li><a href="listings-grid-full-width-with-map.html">عرض کامل + نقشه</a></li>--}}
                                {{-- </ul>--}}
                                {{-- </li>--}}
                                {{-- <li><a href="#">نقشه نیمه صفحه</a>--}}
                                {{-- <ul>--}}
                                {{-- <li><a href="listings-half-screen-map-list.html">چیدمان لیست</a></li>--}}
                                {{-- <li><a href="listings-half-screen-map-grid-1.html">چیدمان شبکه 1</a></li>--}}
                                {{-- <li><a href="listings-half-screen-map-grid-2.html">چیدمان شبکه 2</a></li>--}}
                                {{-- </ul>--}}
                                {{-- </li>--}}
                                {{-- <li><a href="#">آگهی های تک</a>--}}
                                {{-- <ul>--}}
                                {{-- <li><a href="listings-single-page.html">آگهی های تک 1</a></li>--}}
                                {{-- <li><a href="listings-single-page-2.html">آگهی های تک 2</a></li>--}}
                                {{-- <li><a href="listings-single-page-3.html">آگهی های تک 3</a></li>--}}
                                {{-- </ul>--}}
                                {{-- </li>--}}
                                {{-- </ul>--}}
                                {{-- </li>--}}

                                {{-- <li><a class="current" href="#">پنل کاربری</a>--}}
                                {{-- <ul>--}}
                                {{-- <li><a href="dashboard.html">داشبورد</a></li>--}}
                                {{-- <li><a href="dashboard-messages.html">پیام ها</a></li>--}}
                                {{-- <li><a href="dashboard-bookings.html">رزرو ها</a></li>--}}
                                {{-- <li><a href="dashboard-wallet.html">کیف پول</a></li>--}}
                                {{-- <li><a href="dashboard-my-listings.html">آگهی های من</a></li>--}}
                                {{-- <li><a href="dashboard-reviews.html">نظرات</a></li>--}}
                                {{-- <li><a href="dashboard-bookmarks.html">نشانکها</a></li>--}}
                                {{-- <li><a href="dashboard-add-listing.html">افزودن آگهی</a></li>--}}
                                {{-- <li><a href="dashboard-my-profile.html">پروفایل من</a></li>--}}
                                {{-- <li><a href="dashboard-invoice.html">صورتحساب</a></li>--}}
                                {{-- </ul>--}}
                                {{-- </li>--}}

                                {{-- <li><a href="#">صفحات</a>--}}
                                {{-- <div class="mega-menu mobile-styles three-columns">--}}

                                {{-- <div class="mega-menu-section">--}}
                                {{-- <ul>--}}
                                {{-- <li class="mega-menu-headline">صفحات #1</li>--}}
                                {{-- <li><a href="pages-user-profile.html"><i class="sl sl-icon-user"></i> پروفایل کاربر</a></li>--}}
                                {{-- <li><a href="pages-booking.html"><i class="sl sl-icon-check"></i> صفحه رزرو</a></li>--}}
                                {{-- <li><a href="pages-add-listing.html"><i class="sl sl-icon-plus"></i> افزودن آگهی</a></li>--}}
                                {{-- <li><a href="pages-blog.html"><i class="sl sl-icon-docs"></i> بلاگ</a></li>--}}
                                {{-- </ul>--}}
                                {{-- </div>--}}

                                {{-- <div class="mega-menu-section">--}}
                                {{-- <ul>--}}
                                {{-- <li class="mega-menu-headline">صفحات #2</li>--}}
                                {{-- <li><a href="pages-contact.html"><i class="sl sl-icon-envelope-open"></i> تماس</a></li>--}}
                                {{-- <li><a href="pages-coming-soon.html"><i class="sl sl-icon-hourglass"></i> به زودی</a></li>--}}
                                {{-- <li><a href="pages-404.html"><i class="sl sl-icon-close"></i> صفحه 404</a></li>--}}
                                {{-- <li><a href="pages-masonry-filtering.html"><i class="sl sl-icon-equalizer"></i> ساختار فیلتر</a></li>--}}
                                {{-- </ul>--}}
                                {{-- </div>--}}

                                {{-- <div class="mega-menu-section">--}}
                                {{-- <ul>--}}
                                {{-- <li class="mega-menu-headline">و دیگر</li>--}}
                                {{-- <li><a href="pages-elements.html"><i class="sl sl-icon-settings"></i> المنت ها</a></li>--}}
                                {{-- <li><a href="pages-pricing-tables.html"><i class="sl sl-icon-tag"></i> جداول قیمت</a></li>--}}
                                {{-- <li><a href="pages-typography.html"><i class="sl sl-icon-pencil"></i> تایپوگرافی</a></li>--}}
                                {{-- <li><a href="pages-icons.html"><i class="sl sl-icon-diamond"></i> آیکن ها</a></li>--}}
                                {{-- </ul>--}}
                                {{-- </div>--}}

                                {{-- </div>--}}
                                {{-- </li>--}}

                            </ul>
                        </nav>
                        <div class="clearfix"></div>
                        <!-- Main Navigation / End -->

                    </div>
                    <div class="right-side">
                        <!-- Header Widget -->
                        <div class="header-widget">

                            <!-- User Menu -->
                            <div class="user-menu">
                                <div class="user-name">
                                    <span>
                                        @if (auth('web')->user()->avatar !== null)
                                        <img src="{{ getBaseUri(auth('web')->user()->avatar) }}" alt="avatar">
                                        @else
                                        <img src="{{asset('panel/images/avatar.jpg')}}" alt="avatar">
                                        @endif
                                    </span>
                                    حساب کاربری
                                </div>
                                <ul>
                                    <li><a href="{{ route('dashboard') }}"><i class="sl sl-icon-settings"></i> داشبورد</a></li>
                                    {{-- <li><a href="dashboard-messages.html"><i class="sl sl-icon-envelope-open"></i> پیام ها</a></li>--}}
                                    {{-- <li><a href="dashboard-bookings.html"><i class="fa fa-calendar-check-o"></i> رزرو ها</a></li>--}}
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" id="logout">
                                            @csrf
                                        </form>
                                    </li>
                                    <li><a onclick="logout()"><i class="sl sl-icon-power"></i> خروج</a></li>
                                </ul>
                            </div>

                            @yield('plus')
                        </div>
                        <!-- Header Widget / End -->
                    </div>
                </div>
            </div>
        </header>
        <div class="clearfix"></div>
        <div id="dashboard">
            <a href="#" class="dashboard-responsive-nav-trigger"><i class="fa fa-reorder"></i> ناوبری داشبورد</a>
            <div class="dashboard-nav">
                <div class="dashboard-nav-inner">
                    <ul data-submenu-title="اصلی">
                        <li class="{{ isActive('dashboard') }}"><a href="{{route('dashboard')}}"><i class="sl sl-icon-settings"></i> پیشخوان</a></li>
                        @can('admin')
                        <li class="{{isActive(['panel.users','panel.users.create','panel.users.show']) }}">
                            <a href="{{ route('panel.users') }}"><i class="sl sl-icon-user"></i>کاربران</a>
                        </li>
                        @endcan
                        {{-- <li><a href="dashboard-messages.html"><i class="sl sl-icon-envelope-open"></i> پیام ها <span class="nav-tag messages">2</span></a></li>--}}
                        {{-- <li><a href="dashboard-bookings.html"><i class="fa fa-calendar-check-o"></i> رزرو ها</a></li>--}}
                        {{-- <li><a href="dashboard-wallet.html"><i class="sl sl-icon-wallet"></i> کیف پول</a></li>--}}
                    </ul>
                    @can('admin')
                    <ul data-submenu-title="پروژه‌ها">
                        <li class="{{isActive(['panel.projects','panel.projects.create','panel.projects.show']) }}">
                            <a href="{{ route('panel.projects') }}"><i class="sl sl-icon-umbrella"></i>پروژه ها</a>
                        </li>
                        {{-- <li><a href="{{route('panel.projects')}}"><i class="sl sl-icon-umbrella"></i> پروژه‌ها</a></li>--}}
                        {{-- <li><a href="{{route('index')}}"><i class="sl sl-icon-folder"></i> موسسات من</a></li>--}}
                        {{-- <li><a><i class="sl sl-icon-layers"></i> آگهی های من</a>--}}
                        {{-- <ul>--}}
                        {{-- <li><a href="dashboard-my-listings.html">فعال <span class="nav-tag green">6</span></a></li>--}}
                        {{-- <li><a href="dashboard-my-listings.html">در انتظار <span class="nav-tag yellow">1</span></a></li>--}}
                        {{-- <li><a href="dashboard-my-listings.html">منقضی شده <span class="nav-tag red">2</span></a></li>--}}
                        {{-- </ul>--}}
                        {{-- </li>--}}
                        {{-- <li><a href="{{route('projects')}}"><i class="sl sl-icon-umbrella"></i> پروژه‌ها</a></li>--}}
                        {{-- <li><a href="{{route('institutes')}}"><i class="sl sl-icon-folder"></i> موسسات من</a></li>--}}
                        {{-- <li><a><i class="sl sl-icon-layers"></i> آگهی های من</a>--}}
                        {{-- <ul>--}}
                        {{-- <li><a href="dashboard-my-listings.html">فعال <span class="nav-tag green">6</span></a></li>--}}
                        {{-- <li><a href="dashboard-my-listings.html">در انتظار <span class="nav-tag yellow">1</span></a></li>--}}
                        {{-- <li><a href="dashboard-my-listings.html">منقضی شده <span class="nav-tag red">2</span></a></li>--}}
                        {{-- </ul>--}}
                        {{-- </li>--}}
                        <li class="{{ isActive(['post.index','post.create','post.show']) }}"><a href="{{ route('post.index') }}"><i class="sl sl-icon-layers"></i> آگهی های من</a></li>
                        {{-- <li><a href="dashboard-reviews.html"><i class="sl sl-icon-star"></i> نظرات</a></li>--}}
                        {{-- <li><a href="dashboard-bookmarks.html"><i class="sl sl-icon-heart"></i> نشانکها</a></li>--}}
                        {{-- <li><a href="dashboard-add-listing.html"><i class="sl sl-icon-plus"></i> افزودن آگهی</a></li>--}}
                    </ul>
                    @endcan
                    <ul data-submenu-title="حساب کاربری">
                        <li class="{{ isActive('profile') }}"><a href="{{route('profile')}}"><i class="sl sl-icon-user"></i> پروفایل من</a></li>
                        <li><a onclick="logout()"><i class="sl sl-icon-power"></i> خروج</a></li>
                    </ul>
                </div>
            </div>
            @yield('wrapper')
        </div>

    </div>
    <script type="text/javascript" src="{{asset('panel/scripts/jquery-2.2.0.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('panel/scripts/mmenu.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('panel/scripts/chosen.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('panel/scripts/slick.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('panel/scripts/rangeslider.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('panel/scripts/magnific-popup.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('panel/scripts/waypoints.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('panel/scripts/counterup.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('panel/scripts/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('panel/scripts/tooltips.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('panel/scripts/custom.js')}}"></script>
    <script>
        function logout() {
            document.getElementById('logout').submit()
        }
    </script>
    @stack('scripts')
    @yield('scripts')
    @include('sweetalert::alert')
</body>

</html>
