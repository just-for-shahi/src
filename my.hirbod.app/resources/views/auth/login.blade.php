<!DOCTYPE html>
<html lang="fa-IR">
<head>
    <meta charset="utf-8" />
    <title>سامانه مشتریان {{config('app.name')}}</title>
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
</head>
<body class="login">
<div class="app" id="app">
    <div class="padding">
        <div class="navbar">
            <div class="pull-center">
                <a href="{{route('index')}}" class="navbar-brand">
                    <div data-ui-include="'images/logo.svg'"></div>
                    <img src="{{asset('assets/images/logo.png')}}" alt="{{config('app.name')}}" class="hide">
                    <span class="hidden-folded inline text-white">سامانه مشتریان {{config('app.name')}}</span>
                </a>
            </div>
        </div>
    </div>
    <div class="b-t">
        <div class="center-block w-xxl w-auto-xs p-y-md text-center">
            <div class="p-a-md">
                <form method="POST" action="{{ route('login') }}">
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
                    <div>
                        <button type="submit" class="btn btn-block black text-white">ورود</button>
                    </div>
                </form>
{{--                <div>--}}
{{--                    <br/>--}}
{{--                    <a href="{{ route('password.request') }}" class="_600">فراموشی رمز عبور</a>--}}
{{--                </div>--}}
                <div>
                    <br>
                    حساب کاربری ندارید؟
                    <a href="{{route('register')}}" class="text-primary _600">ثبت‌نام کنید</a>
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
