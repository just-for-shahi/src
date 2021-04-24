@extends('partials.front')
@section('wrapper')
<!-- Hero Start -->
<section class="bg-half bg-light">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center">
                        <div class="page-next-level">
                            <h4 class="title"> درباره ما </h4>
                            <ul class="page-next d-inline-block bg-white shadow p-2 pl-4 pr-4 rounded mb-0">
                                <li><a href="{{route('index')}}" class="text-uppercase font-weight-bold text-dark">صرافی آذر</a></li>
                                <li>
                                    <span class="text-uppercase text-primary font-weight-bold">دریاره ما</span>
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
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-5 mt-4 pt-2 mt-sm-0 pt-sm-0">
                <div class="position-relative">
                    <img src="{{asset('images/about.jpg')}}" class="rounded img-fluid mx-auto d-block" alt="">
                    <div class="play-icon">
                        <a href="http://vimeo.com/287684225" class="play-btn video-play-icon">
                            <i class="mdi mdi-play text-primary rounded-pill bg-white shadow"></i>
                        </a>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-7 col-md-7 mt-4 pt-2 mt-sm-0 pt-sm-0">
                <div class="section-title ml-lg-4">
                    <h4 class="title mb-4">داستان ما</h4>
                    <p class="text-muted">تجربه کار با <span class="text-primary font-weight-bold">صرافی آذر </span>
                        متفاوت ترین تجربه شما در حوزه صرافی خواهد بود. با صرافی آذر به راحتی میتوانید ارز دیجیتال بخرید و بفروشید. ما در صرافی آذر بازارچه خرید و فروش بین کاربران ایجاد کردیم. امنیت، سرعت و سهولت سرلوحه کار ما در صرافی آذر هست.
                    </p>
                    <p class="text-muted">علاوه بر این خدمات نوینی همچون سرمایه گذاری، وام دهی، درگاه پرداخت، پرداخت‌های خارجی مانند پی‌پال، ویزا و مسترکارت به همراه خدمات خیریه از جمله خدمات نوین و انحصاری صرافی آذر برای مشتریان و شرکت‌های همراه خود است.</p>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->

    <div class="container mt-100 mt-60">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title mb-4 pb-2">
                    <h4 class="title mb-4">چرا صرافی آذر؟</h4>
                    <p class="text-muted para-desc mx-auto mb-0">تجربه کاری <span class="text-primary font-weight-bold">صرافی آذر </span>نمایان گر یک زیرساخت فنی و مالی قدرتمند هست که در لحظه نیازهای شما را مرتفع می‌سازد.</p>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="key-feature d-flex p-3 rounded shadow bg-white">
                    <div class="icon text-center rounded-pill mr-3">
                        <i class="mdi mdi-responsive text-primary"></i>
                    </div>
                    <div class="content mt-2">
                        <h4 class="title mb-0">کاملا ریسپانسیو</h4>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="key-feature d-flex p-3 rounded shadow bg-white">
                    <div class="icon text-center rounded-pill mr-3">
                        <i class="mdi mdi-internet-explorer text-primary"></i>
                    </div>
                    <div class="content mt-2">
                        <h4 class="title mb-0">سازگاری با مرورگر ها</h4>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="key-feature d-flex p-3 rounded shadow bg-white">
                    <div class="icon text-center rounded-pill mr-3">
                        <i class="mdi mdi-cryengine text-primary"></i>
                    </div>
                    <div class="content mt-2">
                        <h4 class="title mb-0">طراحی کاربری زیبا</h4>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="key-feature d-flex p-3 rounded shadow bg-white">
                    <div class="icon text-center rounded-pill mr-3">
                        <i class="mdi mdi-bootstrap text-primary"></i>
                    </div>
                    <div class="content mt-2">
                        <h4 class="title mb-0">تکنولوژی هوش تجاری</h4>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="key-feature d-flex p-3 rounded shadow bg-white">
                    <div class="icon text-center rounded-pill mr-3">
                        <i class="mdi mdi-cube-outline text-primary"></i>
                    </div>
                    <div class="content mt-2">
                        <h4 class="title mb-0">سرویس‌های متنوع مالی</h4>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="key-feature d-flex p-3 rounded shadow bg-white">
                    <div class="icon text-center rounded-pill mr-3">
                        <i class="mdi mdi-sass text-primary"></i>
                    </div>
                    <div class="content mt-2">
                        <h4 class="title mb-0">دارای امنیت بالای بیومتریک</h4>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="key-feature d-flex p-3 rounded shadow bg-white">
                    <div class="icon text-center rounded-pill mr-3">
                        <i class="mdi mdi-check-decagram text-primary"></i>
                    </div>
                    <div class="content mt-2">
                        <h4 class="title mb-0">ارایه خدمات استاندارد ۲۰۰۲۲</h4>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="key-feature d-flex p-3 rounded shadow bg-white">
                    <div class="icon text-center rounded-pill mr-3">
                        <i class="mdi mdi-vector-bezier text-primary"></i>
                    </div>
                    <div class="content mt-2">
                        <h4 class="title mb-0">تبادل ارزهای مختلف</h4>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-4 col-md-6 mt-4 pt-2">
                <div class="key-feature d-flex p-3 rounded shadow bg-white">
                    <div class="icon text-center rounded-pill mr-3">
                        <i class="mdi mdi-settings-outline text-primary"></i>
                    </div>
                    <div class="content mt-2">
                        <h4 class="title mb-0">ارایه خدمات شرکتی</h4>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row justify-content-center">
            <div class="col-12 text-center mt-4 pt-2">
                <a href="{{route('auth.register')}}" class="btn btn-primary">ثبت نام می‌کنم <i class="mdi mdi-arrow-right"></i></a>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section>
<section class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="section-title mb-4 pb-2">
                    <h4 class="title mb-4">ما یک خانواده هستیم!</h4>
                    <p class="text-muted para-desc mx-auto mb-0">کارکردن کنار همدیگر در <span class="text-primary font-weight-bold">صرافی آذر </span>یک تجربه شیرین هست که هر روزش پر از اتفاقات مشتریان و شرکت‌هایی هست که کمک‌شان می‌کنیم.</p>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-lg-3 col-md-6 mt-4 pt-2">
                <div class="team text-center">
                    <div class="position-relative">
                        <img src="{{asset('images/team/m.shahi.jpg')}}" class="img-fluid avatar avatar-ex-large rounded-pill" alt="">
                        <ul class="list-unstyled social-icon team-icon mb-0 mt-4">
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-facebook" title="فیس بوک"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-instagram" title="اینستاگرام"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-twitter" title="توییتر"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-google-plus" title="گوگل"></i></a></li>
                        </ul>
                    </div>
                    <div class="content pt-3 pb-3">
                        <h5 class="mb-0"><a href="javascript:void(0)" class="name text-dark">میلاد شاهی</a></h5>
                        <small class="designation text-muted">مدیرعامل</small>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-3 col-md-6 mt-4 pt-2">
                <div class="team text-center">
                    <div class="position-relative">
                        <img src="{{asset('images/team/dr.rabani.jpg')}}" class="img-fluid avatar avatar-ex-large rounded-pill" alt="">
                        <ul class="list-unstyled social-icon team-icon mb-0 mt-4">
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-facebook" title="فیس بوک"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-instagram" title="اینستاگرام"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-twitter" title="توییتر"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-google-plus" title="گوگل"></i></a></li>
                        </ul>
                    </div>
                    <div class="content pt-3 pb-3">
                        <h5 class="mb-0"><a href="javascript:void(0)" class="name text-dark">دکتر ربانی</a></h5>
                        <small class="designation text-muted">مشاور</small>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-3 col-md-6 mt-4 pt-2">
                <div class="team text-center">
                    <div class="position-relative">
                        <img src="{{asset('images/team/h.kakavand.jpg')}}" class="img-fluid avatar avatar-ex-large rounded-pill" alt="">
                        <ul class="list-unstyled social-icon team-icon mb-0 mt-4">
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-facebook" title="فیس بوک"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-instagram" title="اینستاگرام"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-twitter" title="توییتر"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-google-plus" title="گوگل"></i></a></li>
                        </ul>
                    </div>
                    <div class="content pt-3 pb-3">
                        <h5 class="mb-0"><a href="javascript:void(0)" class="name text-dark">حمیدرضا کاکاوند</a></h5>
                        <small class="designation text-muted">مدیر حقوقی</small>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-3 col-md-6 mt-4 pt-2">
                <div class="team text-center">
                    <div class="position-relative">
                        <img src="{{asset('images/team/s.khoyi.jpg')}}" class="img-fluid avatar avatar-ex-large rounded-pill" alt="">
                        <ul class="list-unstyled social-icon team-icon mb-0 mt-4">
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-facebook" title="فیس بوک"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-instagram" title="اینستاگرام"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-twitter" title="توییتر"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-google-plus" title="گوگل"></i></a></li>
                        </ul>
                    </div>
                    <div class="content pt-3 pb-3">
                        <h5 class="mb-0"><a href="javascript:void(0)" class="name text-dark">سامان مزرعه لی</a></h5>
                        <small class="designation text-muted">مدیر عملیات</small>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
        <div class="row">
            <div class="col-lg-3 col-md-6 mt-4 pt-2">
                <div class="team text-center">
                    <div class="position-relative">
                        <img src="{{asset('images/team/a.rezaei.jpg')}}" class="img-fluid avatar avatar-ex-large rounded-pill" alt="">
                        <ul class="list-unstyled social-icon team-icon mb-0 mt-4">
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-facebook" title="فیس بوک"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-instagram" title="اینستاگرام"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-twitter" title="توییتر"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-google-plus" title="گوگل"></i></a></li>
                        </ul>
                    </div>
                    <div class="content pt-3 pb-3">
                        <h5 class="mb-0"><a href="javascript:void(0)" class="name text-dark">آرش رضایی</a></h5>
                        <small class="designation text-muted">مدیر مالی</small>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-3 col-md-6 mt-4 pt-2">
                <div class="team text-center">
                    <div class="position-relative">
                        <img src="{{asset('images/team/m.behnam.jpg')}}" class="img-fluid avatar avatar-ex-large rounded-pill" alt="">
                        <ul class="list-unstyled social-icon team-icon mb-0 mt-4">
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-facebook" title="فیس بوک"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-instagram" title="اینستاگرام"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-twitter" title="توییتر"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-google-plus" title="گوگل"></i></a></li>
                        </ul>
                    </div>
                    <div class="content pt-3 pb-3">
                        <h5 class="mb-0"><a href="javascript:void(0)" class="name text-dark">مجتبی بهنام</a></h5>
                        <small class="designation text-muted">مدیر منابع انسانی</small>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-3 col-md-6 mt-4 pt-2">
                <div class="team text-center">
                    <div class="position-relative">
                        <img src="{{asset('images/team/m.nateghi.jpg')}}" class="img-fluid avatar avatar-ex-large rounded-pill" alt="">
                        <ul class="list-unstyled social-icon team-icon mb-0 mt-4">
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-facebook" title="فیس بوک"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-instagram" title="اینستاگرام"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-twitter" title="توییتر"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-google-plus" title="گوگل"></i></a></li>
                        </ul>
                    </div>
                    <div class="content pt-3 pb-3">
                        <h5 class="mb-0"><a href="javascript:void(0)" class="name text-dark">محمد ناطقی</a></h5>
                        <small class="designation text-muted">طراح و گرافیست</small>
                    </div>
                </div>
            </div><!--end col-->


            <div class="col-lg-3 col-md-6 mt-4 pt-2">
                <div class="team text-center">
                    <div class="position-relative">
                        <img src="{{asset('images/team/m.ebrahimi.jpg')}}" class="img-fluid avatar avatar-ex-large rounded-pill" alt="">
                        <ul class="list-unstyled social-icon team-icon mb-0 mt-4">
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-facebook" title="فیس بوک"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-instagram" title="اینستاگرام"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-twitter" title="توییتر"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i class="mdi mdi-google-plus" title="گوگل"></i></a></li>
                        </ul>
                    </div>
                    <div class="content pt-3 pb-3">
                        <h5 class="mb-0"><a href="javascript:void(0)" class="name text-dark">مرضیه ابراهیمی</a></h5>
                        <small class="designation text-muted">پشتیبان</small>
                    </div>
                </div>
            </div><!--end col-->

        </div><!--end row-->
    </div><!--end container-->

    <div class="container mt-100 mt-60">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title">
                    <h4 class="title mb-4">هنوز سوالی باقی مانده است؟!</h4>
                    <p class="text-muted para-desc mx-auto mb-0">همین الان با <span class="text-primary font-weight-bold">صرافی آذر </span>تماس بگیرید. پذیرای صدای گرم‌تان هستیم!</p>

                    <div class="mt-3">
                        <a href="{{route('auth.register')}}" class="btn btn-primary mt-2 mr-2">ثبت‌نام می‌کنم</a>
                        <a href="{{route('pages.contact')}}" class="btn btn-outline-primary mt-2">تماس با ما</a>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section>
@endsection
