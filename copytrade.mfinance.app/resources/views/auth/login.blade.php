@extends('layouts.app')

@section('header')
{{ trans('admin.login') }}
@endsection

@section('content')
<body class="hold-transition login-page {{config('admin.skin')}} {{join(' ', config('admin.layout'))}}" @if(config('admin.login_background_image'))style="background: url({{config('admin.login_background_image')}}) no-repeat;background-size: cover;"@endif>
<div class="login-box">
  <div class="login-logo">
    <a href="{{ admin_url('/') }}">{!! config('admin.login_logo', config('admin.name')) !!}}</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">{{ trans('admin.login') }}</p>

    <form action="{{ admin_url('auth/login') }}" method="post">
      <div class="form-group has-feedback {!! !$errors->has('username') ?: 'has-error' !!}">

        @if($errors->has('username'))
          @foreach($errors->get('username') as $message)
            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label><br>
          @endforeach
        @endif

        <input type="text" class="form-control" placeholder="{{ trans('admin.username') }}" name="username" value="{{ old('username') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback {!! !$errors->has('password') ?: 'has-error' !!}">

        @if($errors->has('password'))
          @foreach($errors->get('password') as $message)
            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label><br>
          @endforeach
        @endif

        <input type="password" class="form-control" placeholder="{{ trans('admin.password') }}" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          @if(config('admin.auth.remember'))
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember" value="1" {{ (!old('username') || old('remember')) ? 'checked' : '' }}>
              {{ trans('admin.remember_me') }}
            </label>
          </div>
          @endif
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('admin.login') }}</button>
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-xs-12">
          <a class="reset_pass" href="{{route('password.request')}}">Lost your password?</a>
          @if(config('admin.login_has_register'))<a class="reset_pass" style="float: right" href="{{route('register')}}">Register</a>@endif
        </div>
      </div>
    </form>
    @if(session()->get('status') == 'info')
    <div class="alert alert-info alert-dismissable">
        <p>{!! session()->get('message') !!}</p>
    </div>
    @endif
    @if(session()->get('status') =='success')
    <div class="alert alert-success alert-dismissable">
        <p>{!! session()->get('message') !!}</p>
    </div>
    @endif
    @if(session()->get('status') =='danger')
    <div class="alert alert-warning alert-dismissable">
        <p>{!! session()->get('message') !!}</p>
    </div>
    @endif
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

</body>
@endsection
