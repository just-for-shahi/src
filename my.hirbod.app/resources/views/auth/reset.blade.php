<!DOCTYPE html>
<html lang="fa-IR">
<head>
    <meta charset="utf-8" />
    <title>ورود به پنل مشتریان - گیتی قیمت</title>
    <meta name="description" content="Responsive, Bootstrap, BS4" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- for ios 7 style, multi-resolution icon of 152x152 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <link rel="apple-touch-icon" href="{{asset('assets/panel/images/logo.png')}}">
    <meta name="apple-mobile-web-app-title" content="Flatkit">
    <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" sizes="196x196" href="{{asset('assets/panel/images/logo.png')}}">

    <!-- style -->
    <link rel="stylesheet" href="{{asset('assets/panel/css/animate.css/animate.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/panel/css/glyphicons/glyphicons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/panel/css/font-awesome/css/font-awesome.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/panel/css/material-design-icons/material-design-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/panel/css/ionicons/css/ionicons.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/panel/css/simple-line-icons/css/simple-line-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/panel/css/bootstrap/dist/css/bootstrap.min.css')}}" type="text/css" />

    <!-- build:css css/styles/app.min.css -->
    <link rel="stylesheet" href="{{asset('assets/panel/css/styles/app.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/panel/css/styles/style.css')}}" type="text/css" />
    <!-- endbuild -->
    <link rel="stylesheet" href="{{asset('assets/panel/css/styles/font.css')}}" type="text/css" />
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
    <div class="padding">
        <div class="navbar">
            <div class="pull-center">
                <!-- brand -->
                <a href="{{route('index')}}" class="navbar-brand">
                    <div data-ui-include="'images/logo.svg'"></div>
                    <img src="{{asset('assets/panel/images/logo.png')}}" alt="." class="hide">
                    <span class="hidden-folded inline">پنل مشتریان</span>
                </a>
                <!-- / brand -->
            </div>
        </div>
    </div>
    <div class="b-t">
        <div class="center-block w-xxl w-auto-xs p-y-md text-center">
            <div class="p-a-md">
                <form method="POST" action="{{ route('resetPassword') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="پست الکترونیکی" value="{{old('email')}}" autofocus required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="رمز عبور" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-lg black p-x-lg">تنظیم رمزعبور</button>
                </form>
                <div class="m-y">
                    <a href="{{ route('login') }}" class="_600">ورود</a>
                </div>
                <div>
                    حساب کاربری ندارید
                    <a href="{{route('register')}}" class="text-primary _600">عضویت</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ############ LAYOUT END-->
</div>

<!-- build:js scripts/app.min.js -->
<!-- jQuery -->
<script src="{{asset('assets/panel/libs/jquery/dist/jquery.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('assets/panel/libs/tether/dist/js/tether.min.js')}}"></script>
<script src="{{asset('assets/panel/libs/bootstrap/dist/js/bootstrap.js')}}"></script>
<!-- core -->
<script src="{{asset('assets/panel/libs/jQuery-Storage-API/jquery.storageapi.min.js')}}"></script>
<script src="{{asset('assets/panel/libs/PACE/pace.min.js')}}"></script>
<script src="{{asset('assets/panel/libs/jquery-pjax/jquery.pjax.js')}}"></script>
<script src="{{asset('assets/panel/libs/blockUI/jquery.blockUI.js')}}"></script>
<script src="{{asset('assets/panel/libs/jscroll/jquery.jscroll.min.js')}}"></script>

<script src="{{asset('assets/panel/scripts/config.lazyload.js')}}"></script>
<script src="{{asset('assets/panel/scripts/ui-load.js')}}"></script>
<script src="{{asset('assets/panel/scripts/ui-jp.js')}}"></script>
<script src="{{asset('assets/panel/scripts/ui-include.js')}}"></script>
<script src="{{asset('assets/panel/scripts/ui-device.js')}}"></script>
<script src="{{asset('assets/panel/scripts/ui-form.js')}}"></script>
<script src="{{asset('assets/panel/scripts/ui-modal.js')}}"></script>
<script src="{{asset('assets/panel/scripts/ui-nav.js')}}"></script>
<script src="{{asset('assets/panel/scripts/ui-list.js')}}"></script>
<script src="{{asset('assets/panel/scripts/ui-screenfull.js')}}"></script>
<script src="{{asset('assets/panel/scripts/ui-scroll-to.js')}}"></script>
<script src="{{asset('assets/panel/scripts/ui-toggle-class.js')}}"></script>
<script src="{{asset('assets/panel/scripts/ui-taburl.js')}}"></script>
<script src="{{asset('assets/panel/scripts/app.js')}}"></script>
<script src="{{asset('assets/panel/scripts/ajax.js')}}"></script>
<!-- endbuild -->
</body>
</html>

