@extends('layout.base')
@section('pageTitle', 'صفحه‌نخست')
@section('wrapper')
    <section class="bg-center bg-no-repeat py-5 mt-lg-5" style="background-image: url({{asset('img/homepages/digital-agency/hero-bg.png')}});">
        <div class="row no-gutters mt-lg-5">
            <div class="col-xl-7 col-lg-8"><img class="d-block" src="{{asset('img/homepages/digital-agency/hero-img.jpg')}}" alt="آذرسرمایه"></div>
            <div class="col-lg-4 pt-xl-5">
                <div class="px-3 px-lg-0 text-center text-lg-right">
                    <h1 class="pt-md-5 pb-md-4 pt-3 pb-2 pt-md-0 pb-md-3">سرمایه شما هم رشد کرده؟</h1><h6 class="fw-200 pb-md-4 pb-3 pt-md-0 pb-md-5">
                    آذرسرمایه اولین مرکز سرمایه گذاری در بازارهای مالی و ارزهای دیجیتال است. با توجه به تحریم های مالی ظالمانه و یکطرفه استکبار جهانی علیه کشور عزیزمان ایران، ما در آذرسرمایه با ضمانت هوشمند سرمایه شما بستری مستحکم و ایمن برای معاملات و سرمایه در ارزهای دیجیتال را فراهم کرده ایم.
                    </h6><a class="scroll-to btn btn-gradient btn-icon-left btn-lg" href="#services">خدمات<i class="fe-icon-arrow-down"></i></a>
                </div>
            </div>
        </div>
    </section>
    <!-- Statistics-->
    <section class="bg-white container-fluid border-top">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 border-right py-5 border-bottom">
                    <div class="animated-digits mx-auto text-center" data-number="{{\App\Models\User::all()->count()}}">
                        <h5 class="animated-digits-digit"><span>0</span>+</h5>
                        <p class="animated-digits-text">خانواده آذرسرمایه</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 py-5 border-right border-bottom">
                    <div class="animated-digits mx-auto text-center" data-number="58">
                        <h5 class="animated-digits-digit"><span>0</span>%</h5>
                        <p class="animated-digits-text">رشد سرمایه یک‌سال </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 py-5 border-right border-bottom">
                    <div class="animated-digits mx-auto text-center" data-number="{{\App\Models\Transaction::all()->count()}}">
                        <h5 class="animated-digits-digit"><span>0</span></h5>
                        <p class="animated-digits-text">تراکنش مالی</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 py-5 border-right border-left">
                    <div class="animated-digits mx-auto text-center" data-number="3">
                        <h5 class="animated-digits-digit">%<span>0</span></h5>
                        <p class="animated-digits-text">سود ماهانه</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-accent py-5" id="services">
        <div class="container pt-4">
            <h2 class="h3 block-title text-white text-center px-3">طرح های سرمایه گذاری آذرسرمایه</h2>
            <div class="row pt-4">
                <div class="col-lg-4 col-sm-6 mb-30"><a class="d-block bg-white box-shadow text-decoration-none" href="#"><img class="d-block w-100" src="{{asset('img/homepages/digital-agency/services/01.jpg')}}" alt="طرح سرمایه گذاری جوانان">
                        <div class="p-4">
                            <h3 class="text-xl font-weight-bold mb-0">جوانان</h3>
                        </div></a></div>
                <div class="col-lg-4 col-sm-6 mb-30"><a class="d-block bg-white box-shadow text-decoration-none" href="#"><img class="d-block w-100" src="{{asset('img/homepages/digital-agency/services/02.jpg')}}" alt="طرح سرمایه گذاری آینده نگر">
                        <div class="p-4">
                            <h3 class="text-xl font-weight-bold mb-0">آینده نگر</h3>
                        </div></a></div>
                <div class="col-lg-4 col-sm-6 mb-30"><a class="d-block bg-white box-shadow text-decoration-none" href="#"><img class="d-block w-100" src="{{asset('img/homepages/digital-agency/services/03.jpg')}}" alt="طرح سرمایه گذاری بازنشستگان">
                        <div class="p-4">
                            <h3 class="text-xl font-weight-bold mb-0">بازنشستگان (زودبازده)</h3>
                        </div></a></div>
            </div>
        </div>
    </section>
    <section class="bg-center-top bg-no-repeat bg-cover py-5" style="background-image: url({{asset('img/homepages/digital-agency/steps-bg.jpg')}});">
        <div class="container-fluid pt-4">
            <div class="row pt-1">
                <div class="col-xl-8 offset-xl-1">
                    <h2 class="h3 mb-4 ml-lg-3 text-center text-lg-right">تنها در ۳ مرحله به خانواده آذرسرمایه بپیوندید</h2>
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <!-- Step-->
                            <div class="step step-with-icon">
                                <div class="step-number">۱</div>
                                <div class="step-icon"><img src="{{asset('img/icons/user-data.svg')}}" alt="Gathering User Data"></div>
                                <h3 class="step-title">ثبت نام در پنل آذرسرمایه</h3>
                                <p class="step-text text-sm">ثبت نام آنلاین در پنل سرمایه گذاری آذرسرمایه اینوست </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <!-- Step-->
                            <div class="step step-with-icon">
                                <div class="step-number">۲</div>
                                <div class="step-icon"><img src="{{asset('img/icons/prototyping.svg')}}" alt="Prototyping (Wireframes)"></div>
                                <h3 class="step-title">احراز هویت و تکمیل مدارک</h3>
                                <p class="step-text text-sm">ارسال مدارک هویتی جهت احراز و ثبت حساب بانکی</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="step step-with-icon">
                                <div class="step-number">۳</div>
                                <div class="step-icon"><img src="{{asset('img/icons/coding.svg')}}" alt="Development (Coding)"></div>
                                <h3 class="step-title">شروع سرمایه گذاری</h3>
                                <p class="step-text text-sm">سرمایه گذاری و دربافت سود سرمایه در هر زمان</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Portfolio-->

    <!-- Contact Form-->
    <section class="bg-secondary pt-5 pb-3">
        <div class="container py-2">
            <h2 class="h3 block-title text-center">درخواست تماس<small>کارشناسان آذرسرمایه با شما تماس می‌گیرند! </small></h2>
            <form class="needs-validation pt-4 pb-5" novalidate method="post" action="{{route('callRequests.store')}}">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-6 form-group">
                        <label for="cont-name">نام <span class='text-danger font-weight-medium'>*</span></label>
                        <input class="form-control" type="text" name="name" id="cont-name" placeholder="نام و نام خانوادگی" required>
                        <div class="invalid-feedback">لطفا نام خود را وارد کنید!</div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="cont-subject">شماره تماس</label>
                        <input class="form-control" name="phone" type="number" id="cont-subject" placeholder="شماره تماس شما" required>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-style-4 btn-icon-left btn-primary" type="submit"><i class="fe-icon-mail text-md bg-white text-primary"></i>ثبت درخواست تماس</button>
                </div>
            </form>
        </div>
    </section>
@endsection
