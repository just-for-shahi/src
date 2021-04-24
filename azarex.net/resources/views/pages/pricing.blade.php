@extends('partials.front')
@section('wrapper')

    <section class="bg-half bg-light">
        <div class="home-center">
            <div class="home-desc-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 text-center">
                            <div class="page-next-level">
                                <h4 class="title"> کارمزدها </h4>
                                <ul class="page-next d-inline-block bg-white shadow p-2 pl-4 pr-4 rounded mb-0">
                                    <li><a href="{{route('index')}}" class="text-uppercase font-weight-bold text-dark">صرافی آذر</a></li>
                                    <li>
                                        <span class="text-uppercase text-primary font-weight-bold">کارمزدها</span>
                                    </li>
                                </ul>
                            </div>
                        </div>  <!--end col-->
                    </div><!--end row-->
                </div> <!--end container-->
            </div>
        </div>
    </section>
    <div class="position-relative">
        <div class="shape overflow-hidden text-white">
            <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="section-title mb-4 pb-2">
                        <p class="text-muted para-desc mb-0 mx-auto">ما در <span class="text-primary font-weight-bold">صرافی آذر </span>خدمات ویژه‌تری برای مشتریان خود در نظر گرفتیم.</p>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

            <div class="row align-items-center">
                <div class="col-md-4 col-12 mt-4 pt-2">
                    <div class="pricing-rates business-rate shadow bg-light pt-5 pb-5 p-4 rounded text-center">
                        <h2 class="title text-uppercase mb-4">رایگان</h2>
                        <div class="d-flex justify-content-center mb-4">
                            <span class="price h1 mb-0">0</span>
                            <span class="h4 mb-0 mt-2">تومان</span>
                            <span class="h6 align-self-end mb-1">هرماه </span>
                        </div>

                        <ul class="feature list-unstyled pl-0">
                            <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>خرید و فروش ارزهای دیجیتال</li>
                            <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>خدمات پرداخت خارجی</li>
                            <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>خدمات بانک‌های ایرانی</li>
                            <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>خدمات سرمایه‌گذاری</li>
                        </ul>
                        <a href="{{route('auth.register')}}" class="btn btn-primary mt-4">ثبت‌نام کنید</a>
                    </div>
                </div><!--end col-->

                <div class="col-md-4 col-12 mt-4 pt-2">
                    <div class="pricing-rates business-rate shadow bg-white pt-5 pb-5 p-4 rounded text-center">
                        <h2 class="title text-uppercase text-primary mb-4">خوارزمی</h2>
                        <div class="d-flex justify-content-center mb-4">
                            <span class="price h1 mb-0">۳۹۹٬۰۰۰ </span>
                            <span class="h4 mb-0 mt-2">تومان</span>
                            <span class="h6 align-self-end mb-1">هرماه </span>
                        </div>

                        <ul class="feature list-unstyled pl-0">
                            <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>کارمزد سطح دوم</li>
                            <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>کیف‌پول‌های اختصاصی</li>
                            <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>دسترسی کامل به توکن آذر</li>
                            <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>خدمات درگاه پرداخت</li>
                            <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>خدمات وام دهی</li>
                        </ul>
                        <a href="{{route('pages.contact')}}" class="btn btn-primary mt-4">شروع می‌کنم</a>
                    </div>
                </div><!--end col-->

                <div class="col-md-4 col-12 mt-4 pt-2">
                    <div class="pricing-rates business-rate shadow bg-light pt-5 pb-5 p-4 rounded text-center">
                        <h2 class="title text-uppercase mb-4">حرفه ای</h2>
                        <div class="d-flex justify-content-center mb-4">
                            <span class="price h1 mb-0">۷۹۹٬۰۰۰ </span>
                            <span class="h4 mb-0 mt-2">تومان</span>
                            <span class="h6 align-self-end mb-1">هرماه </span>
                        </div>

                        <ul class="feature list-unstyled pl-0">
                            <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>کارمزد سطح سوم</li>
                            <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>حساب‌های مالی</li>
                            <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>تالار معاملات اختصاصی</li>
                            <li class="feature-list"><i class="mdi mdi-check text-success h5 mr-1"></i>خدمات بیمه</li>
                        </ul>
                        <a href="{{route('pages.contact')}}" class="btn btn-primary mt-4">شروع می‌کنم</a>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->

    </section>

    <section class="section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="faq-container">
                        <h4 class="question"><i class="mdi mdi-help-circle text-primary mr-2 h4"></i> خدمات ویژه <span class="text-primary"> صرافی آذر </span> چگونه است؟</h4>
                        <p class="answer text-muted ml-lg-4 pl-lg-3 mb-0">به دلیل استفاده گسترده خدمات صرافی آذر، ما سطح خدمات ویژه‌تری را برای مشتریان خاص و سازمانی خود در نظر گرفته‌ایم. با خریداری اشتراک متناسب نیازهای خود می‌توانید از امکانات و کیفیت بیشتری برخوردار باشید.</p>
                    </div>
                </div><!--end col-->

                <div class="col-md-6 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="faq-container">
                        <h4 class="question"><i class="mdi mdi-help-circle text-primary mr-2 h4"></i> توکن آذر چیست؟</h4>
                        <p class="answer text-muted ml-lg-4 pl-lg-3 mb-0">توکن آذر، ارز مجازی متمرکز صرافی آذر است. این توکن طراحی و تولید شده داخل کشور و با بهره گیری از نمونه‌های بین المللی پیاده سازی شده است. توکن آذر یک فرصت سرمایه گذاری بالقوه است.</p>
                    </div>
                </div><!--end col-->

                <div class="col-md-6 col-12 mt-4 pt-2">
                    <div class="faq-container">
                        <h4 class="question"><i class="mdi mdi-help-circle text-primary mr-2 h4"></i>خدمات وام دهی به چه صورت است؟</h4>
                        <p class="answer text-muted ml-lg-4 pl-lg-3 mb-0">ما در این زیرساخت یک پلتفرم کامل و انحصاری را برای شرکت‌ها و اشخاص جهت اعطا و دریافت وام طراحی و پیاده سازی کردیم. جهت اطلاعات بیشتر با ما <a href="{{route('pages.contact')}}">تماس بگیرید</a>.</p>
                    </div>
                </div><!--end col-->

                <div class="col-md-6 col-12 mt-4 pt-2">
                    <div class="faq-container">
                        <h4 class="question"><i class="mdi mdi-help-circle text-primary mr-2 h4"></i> خدمات سرمایه‌گذاری در  <span class="text-primary"> صرافی آذر </span> چگونه است؟ </h4>
                        <p class="answer text-muted ml-lg-4 pl-lg-3 mb-0">ما در صرافی آذر جهت حال رفاه مشتریان و جلوگیری از کلاهبرداری‌های معمول در سطح اینترنت اقدام به جمع‌آوری دایرکتوری از سایت‌ها و مجموعه‌های معتبر ایرانی و خارجی در زمینه سرمایه‌گذاری انجام دادیم که مشتریان با توجه به شرایط و متناسب با مبالغ خود می‌توانند اقدام کنند.</p>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

            <div class="row mt-md-5 pt-md-3 mt-4 pt-2 mt-sm-0 pt-sm-0 justify-content-center">
                <div class="col-12 text-center">
                    <div class="section-title">
                        <h4 class="title mb-4">سوال دارید؟ در تماس باشید!</h4>
                        <p class="text-muted para-desc mx-auto">همین الان می‌توانید با <span class="text-primary font-weight-bold">صرافی آذر </span>تماس بگیرید. ما مشتاقانه پذیرای صدای گرم‌تان هستیم.</p>
                        <a href="{{route('pages.contact')}}" class="btn btn-primary mt-4">تماس با ما <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section>

@endsection
