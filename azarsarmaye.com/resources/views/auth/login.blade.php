@extends('layout.base')
@section('pageTitle', 'ورود به حساب کاربری')
@section('wrapper')
    <div class="container mt-6 mb-3">
        <div class="row">
            <div class="col-md-6 pb-5">
                <form class="needs-validation wizard" novalidate="" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="wizard-body pt-2">
                        <h3 class="h5 pt-4 pb-2">ورود/ثبت‌نام</h3>
                        @if($errors->has('error'))
                            <div class="alert alert-danger">
                                لطفا اطلاعات ارسالی خود را بررسی کنید!
                            </div>
                        @endif
                        <div class="input-group form-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fe-icon-mail"></i></span></div>
                            <input type="email" name="email" class="form-control text-left placeholder-right{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="مانند sima.nazemi@gmail.com" value="{{old('email')}}" autofocus required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                            <div class="invalid-feedback">لطفا ایمیل خود را بررسی نمایید!</div>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fe-icon-lock"></i></span></div>
                            <input type="password" name="password" class="form-control text-left placeholder-right{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="رمزعبور خود را وارد کنید" value="{{old('password')}}" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                            <div class="invalid-feedback">لطفا رمزعبور خود را بررسی نمایید!</div>
                        </div>
                        <div class="d-flex flex-wrap justify-content-between">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" checked="" id="remember-me">
                                <label class="custom-control-label" for="remember-me">مرا به خاطر بسپار</label>
                            </div>
                            <a class="navi-link" href="{{ route('contact') }}">رمز عبور را فراموش کرده اید ؟</a>
                        </div>
                    </div>
                    <div class="wizard-footer text-right">
                        <button class="btn col-12 btn-primary" type="submit">دریافت کد تاییدیه</button>
                    </div>
                    <div class="d-sm-flex justify-content-between pb-2">
                        <a class="btn btn-secondary btn-block my-2 ml-3 mr-3" href="{{route('auth.social')}}">ورود با&nbsp;<i class="socicon-google"></i></a>
                        <a class="btn btn-secondary btn-block my-2 ml-3 mr-3" href="#">ورود با&nbsp;<i class="socicon-linkedin"></i></a>
                    </div>
                </form>
                <p class="col-12 text-center text-justify pt-5">آیا هنوز حساب کاربری ندارید؟ <a class="text-primary" href="{{route('register')}}">ثبت‌نام کنید!</a></p>
            </div>
            <div class="col-md-6 pb-5">
                <h3 class="h4 pb-1">نکات ایمنی</h3>
                <p>کاربر گرامی توجه داشته باشید، یکی از اصلی‌ترین دغدغه ما در آذرسرمایه حفظ امنیت حساب کاربری و سرمایه‌گذاری‌های شما مشتریان عزیز می‌باشد. لطفا به نکات زیر توجه داشته باشید.</p>
                <ul>
                    <li>آدرس آذرسرمایه حتما با HTTPS شروع شده باشد.</li>
                    <li>تنها آدرس رسمی آذرسرمایه <strong>AZARSARMAYE.COM</strong> است.</li>
                    <li>در صورتی که از مکان‌های عمومی برای ورود به سیستم استفاده می‌کنید، گزینه «مرا بخاطر بسپار» را غیر فعال کنید.</li>
                    <li>حتما از آخرین نسخه مرورگرهای معتبر مانند Google Chrome و یا Mozilla Firefox استفاده کنید.</li>
                    <li>هیچ کدام از کارمندان و تیم آذرسرمایه به هیچ طریقی اعم از تلفنی و ایمیل و تیکت، از شما درخواست اطلاعات حساب کاربری شما را نخواهند داشت.</li>
                    <li>در صورتی که از طریق شماره موبایل وارد می‌شوید به هیچ وجه کد ارسالی را در اختیار دیگران قرار ندهید.</li>
                    <li>در صورتی که هر مورد مشکوکی در حساب کاربری یا تراکنش‌های خود مشاهده کردید، سریعا مراتب را به ما اطلاع دهید.</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
