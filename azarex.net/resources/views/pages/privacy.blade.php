@extends('partials.front')
@section('wrapper')

    <section class="bg-half bg-light">
        <div class="home-center">
            <div class="home-desc-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 text-center">
                            <div class="page-next-level">
                                <h4 class="title"> حریم خصوصی </h4>
                                <ul class="list-unstyled mt-4">
                                    <li class="list-inline-item h6 date text-muted"> <span class="text-dark">آخرین بازبینی :</span> بهمن ۱۳۹۹</li>
                                </ul>
                                <ul class="page-next d-inline-block bg-white shadow p-2 pl-4 pr-4 rounded mb-0">
                                    <li><a href="{{route('index')}}" class="text-uppercase font-weight-bold text-dark">صرافی آذر</a></li>
                                    <li>
                                        <span class="text-uppercase text-primary font-weight-bold"> حریم خصوصی </span>
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
                <div class="col-lg-9">
                    <div class="p-4 shadow rounded border">
                        <h5>بررسی اجمالی :</h5>
                        <p class="text-muted">به نظر می رسد که تنها بخش هایی از متن اصلی در متون مورد استفاده امروز باقی مانده است. ممکن است گمانه زنی شود که به مرور زمان حروف خاصی در موقعیتهای مختلف متن اضافه یا حذف شدند.</p>
                        <h5>ما از اطلاعات شما استفاده می کنیم :</h5>
                        <ul class="list-unstyled feature-list text-muted">
                            <li><i class="mdi mdi-pan-right mdi-24px mr-2"></i>راه حل های دیجیتال مارکتینگ برای فردا</li>
                            <li><i class="mdi mdi-pan-right mdi-24px mr-2"></i>آژانس بازاریابی با استعداد و مجرب ما</li>
                            <li><i class="mdi mdi-pan-right mdi-24px mr-2"></i>پوست خود را بسازید تا با برند شما مطابقت داشته باشد</li>
                            <li><i class="mdi mdi-pan-right mdi-24px mr-2"></i>راه حل های دیجیتال مارکتینگ برای فردا</li>
                            <li><i class="mdi mdi-pan-right mdi-24px mr-2"></i>آژانس بازاریابی با استعداد و مجرب ما</li>
                            <li><i class="mdi mdi-pan-right mdi-24px mr-2"></i>پوست خود را بسازید تا با برند شما مطابقت داشته باشد</li>
                        </ul>

                        <h5>اطلاعات به صورت داوطلبانه ارائه می شود :</h5>
                        <p class="text-muted">به نظر می رسد که تنها بخش هایی از متن اصلی در متون مورد استفاده امروز باقی مانده است. ممکن است گمانه زنی شود که به مرور زمان حروف خاصی در موقعیتهای مختلف متن اضافه یا حذف شدند.</p>

                        <a href="javascript:void(0)" class="btn btn-primary">چاپ</a>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section>

@endsection
