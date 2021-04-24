
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="description" content="Responsive, Bootstrap, BS4" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <link rel="apple-touch-icon" href="{{asset('assets/images/logo.png')}}">
    <meta name="apple-mobile-web-app-title" content="Flatkit">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" sizes="196x196" href="{{asset('assets/images/logo.png')}}">
    <link rel="stylesheet" href="{{asset('assets/css/animate.css/animate.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/css/glyphicons/glyphicons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome/css/font-awesome.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/css/material-design-icons/material-design-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/css/ionicons/css/ionicons.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/css/simple-line-icons/css/simple-line-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap/dist/css/bootstrap.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/css/styles/app.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/css/styles/style.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/css/styles/font.css')}}" type="text/css" />
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-117500515-18"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-117500515-18');
    </script>
</head>
<body>
<div class="app" id="app">
    <div class="p-a black">
        <div class="navbar" data-pjax>
            <a data-toggle="collapse" data-target="#navbar" class="navbar-item pull-right hidden-md-up m-a-0 m-l">
                <i class="ion-android-menu"></i>
            </a>
            <a href="{{route('index')}}" class="navbar-brand">
                <div data-ui-include="'{{asset('assets/images/logo.svg')}}'"></div>
                <img src="{{asset('assets/images/logo.png')}}" alt="{{config('app.name')}}" class="hide">&nbsp;&nbsp;&nbsp;
                <span class="hidden-folded inline">&nbsp;&nbsp;&nbsp;{{config('app.name')}}</span>
            </a>
            <div class="collapse navbar-toggleable-sm pull-right pull-none-xs" id="navbar">
                <ul class="nav navbar-nav text-info-hover" data-ui-nav>
                    <li class="nav-item">
                        <a href="{{route('login')}}" class="nav-link">
                      <span class="btn btn-md rounded info">
                        ورود
                      </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('register')}}" class="nav-link">
                      <span class="nav-text text-info">
                        عضویت
                      </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('investments.index')}}" data-ui-scroll-to class="nav-link">
                            <span class="nav-text">سرمایه گذاری</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="content" class="app-content" role="main">
        <div class="app-body">
            <div class="row-col amber p-t-3">
                <div class="row-cell v-m">
                    <div class="text-center col-sm-6 offset-sm-3 p-y-lg">
                        <h1 class="display-3 m-b-3">@yield('message')</h1>
                        <div align="center" style="font-size:50px;">-- @yield('code') --
                        </div>
                        <p class="m-y text-muted h4">

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer black text-info-hover">
        <div class="container">
            <div class="p-y-lg b-b">
                <a href="{{route('investments.index')}}" class="btn info rounded pull-right pull-none-xs">سرمایه‌گذاری میکنم</a>
                <div class="m-r">
                    <div class="text-md p-y-sm2">همین الان رشد مالی خود را تنها با صدهزارتومان شروع کنید</div>
                </div>
            </div>
        </div>
        <div class="p-y-lg">
            <div class="m-b-lg text-sm">
                <div align="center">
                    <span class="text-muted">.تمامی حقوق برای <strong>«آذران تجارت الکترونیک شهریار»</strong> محفوظ است&copy; </span>
                    <div class="text-muted pull-right pull-none-xs m-b"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="{{asset('assets/libs/jquery/dist/jquery.js')}}"></script>
<script src="{{asset('assets/libs/tether/dist/js/tether.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/libs/jQuery-Storage-API/jquery.storageapi.min.js')}}"></script>
<script src="{{asset('assets/libs/PACE/pace.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery-pjax/jquery.pjax.js')}}"></script>
<script src="{{asset('assets/libs/blockUI/jquery.blockUI.js')}}"></script>
<script src="{{asset('assets/libs/jscroll/jquery.jscroll.min.js')}}"></script>
<script src="{{asset('assets/scripts/config.lazyload.js')}}"></script>
<script src="{{asset('assets/scripts/ui-load.js')}}"></script>
<script src="{{asset('assets/scripts/ui-jp.js')}}"></script>
<script src="{{asset('assets/scripts/ui-include.js')}}"></script>
<script src="{{asset('assets/scripts/ui-device.js')}}"></script>
<script src="{{asset('assets/scripts/ui-form.js')}}"></script>
<script src="{{asset('assets/scripts/ui-modal.js')}}"></script>
<script src="{{asset('assets/scripts/ui-nav.js')}}"></script>
<script src="{{asset('assets/scripts/ui-list.js')}}"></script>
<script src="{{asset('assets/scripts/ui-screenfull.js')}}"></script>
<script src="{{asset('assets/scripts/ui-scroll-to.js')}}"></script>
<script src="{{asset('assets/scripts/ui-toggle-class.js')}}"></script>
<script src="{{asset('assets/scripts/ui-taburl.js')}}"></script>
<script src="{{asset('assets/scripts/app.js')}}"></script>
<script src="{{asset('assets/scripts/ajax.js')}}"></script>
</body>
</html>
