@extends('partials.front')
@section('page.title', 'ورود یا ثبت‌نام')
@section('wrapper')
<main class="main">
    <section class="section forms-section">
        <div class="container">
            <div class="row margin-bottom">
                <div class="col-lg-6">
                    <div class="heading heading--primary"><span class="heading__pre-title">خوشحال دوباره کنارهم هستیم.</span>
                        <h2 class="heading__title"><span>ورود</span> <span>یا ثبت‌نام</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if($errors->has('error'))
                    <div class="alert alert-danger">
                        لطفا اطلاعات ارسالی خود را بررسی کنید!
                    </div>
                    <br />
                    @endif
                    <form class="form user-form" method="post" action="{{route('verify')}}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <input class="form__field" type="tel" name="mobile" value="{{old('mobile')}}"
                                placeholder="شماره موبایل (09121230000) یا ایمیل(info@email.com) " />
                                <button class="form__submit" type="submit">دریافت کدتاییدیه </button>
                            </div>
                            <div class="col-lg-6">
                                <ul>
                                    <li>آدرس مهرینو حتما با HTTPS شروع شده باشد.</li>
                                    <li>تنها آدرس رسمی مهرینو <strong>MEHRINO.NET</strong> است.</li>
                                    <li>هیچ کدام از کارمندان و تیم مهرینو به هیچ طریقی اعم از تلفنی و ایمیل و تیکت، از شما درخواست اطلاعات حساب کاربری شما را نخواهند داشت.</li>
                                    <li>در صورتی که از طریق شماره موبایل وارد می‌شوید به هیچ وجه کد ارسالی را در اختیار دیگران قرار ندهید.</li>
                                    <li>در صورتی که هر مورد مشکوکی در حساب کاربری یا تراکنش‌های خود مشاهده کردید، سریعا مراتب را به ما اطلاع دهید.</li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
