@extends('layouts.app')

@section('header')
{{ trans('auth.register') }}
@endsection

@section('content')
    <body class="hold-transition register-page" {{config('admin.skin')}} {{join(' ', config('admin.layout'))}} @if(config('admin.login_background_image'))style="background: url({{config('admin.login_background_image')}}) no-repeat;background-size: cover;"@endif>
    <div class="register-box" style="width: 340px; margin: 1% auto;">
        <div class="register-logo">
            <a href="{{ admin_base_path('/register') }}"><b>{{ Admin::title() }} - {{ trans('auth.register') }}</b></a>
        </div>

        <div class="register-box-body">
            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="{{ trans('auth.ph_name') }}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group has-feedback">
                    <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="{{ trans('auth.ph_email') }}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" required placeholder="{{ trans('auth.ph_password') }}">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="{{ trans('auth.ph_password_conf') }}">
                </div>
                <div class="form-group">
                @if(config('admin.reCaptchStatus'))
                    <div class="g-recaptcha" data-sitekey="{{ config('admin.reCaptchSite') }}"></div>
                @endif
                </div>
                <div class="form-group">
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Register') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <a href="{{route('admin.login')}}">Back to Login</a>
                    </div>
                </div>
                <!-- div class="row">
                    <div class="col-12">
                        <p class="text-center mb-4">
                            Or Use Social Logins to Register
                        </p>
                    </div>
                </!-->
                <!--@include('partials.socials')-->
            </form>
        </div>
    </div>
    @if(config('admin.reCaptchStatus'))
        <script src='https://www.google.com/recaptcha/api.js'></script>
    @endif
    </body>
@endsection