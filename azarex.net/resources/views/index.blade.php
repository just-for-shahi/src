@extends('partials.front')
@section('wrapper')
<!-- Hero Start -->
<section class="bg-half bg-light" style="background: url('{{asset('images/crypto/bg.png')}}') center center;">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container">
                <div class="row mt-5 justify-content-center">
                    <div class="col-lg-10">
                        <div class="title-heading text-center">
                            <img src="{{asset('images/crypto/crypto.svg')}}" height="136" class="mover" alt="">
                            <h1 class="heading text-primary text-shadow-title mt-4 mb-3">متفاوت ترین صرافی ارز دیجیتال ایران!</h1>
                            <br>
                            <br>
                            <br>
                            <br>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </div><!--end home desc center-->
    </div><!--end home center-->
</section><!--end section-->
<!-- Hero End -->

<!-- FEATURES START -->
<section class="section border-top">
    <!-- Table Start -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="table-responsive crypto-table bg-white shadow rounded">
                    <table class="table mb-0 table-center">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">نام</th>
                            <th scope="col" style="max-width: 150px;">قیمت</th>
                            <th scope="col" style="max-width: 150px;">تغییر</th>
                            <th scope="col" style="max-width: 150px;">تجارت</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td scope="row">1</td>
                            <th>
                                <img src="{{asset('images/crypto/litecoin.png')}}" class="float-left mr-3" height="50" alt="">
                                <p class="mt-2 mb-0 font-weight-normal h5">لایت کوین <span class="text-muted h6">LTC</span> </p>
                            </th>
                            <td>{{number_format(floatval($ltcPrice['price']),2)}} $</td>
                            <td class="@if(strpos($ltcPrice['change'], '-')===false) text-success @else text-danger @endif">{{$ltcPrice['change']}}</td>
                            <td><a href="{{route('panel.exchanges.index')}}" class="btn btn-primary">خرید و فروش </a></td>
                        </tr>

                        <tr>
                            <td scope="row">2</td>
                            <th>
                                <img src="{{asset('images/crypto/bitcoin.png')}}" class="float-left mr-3" height="50" alt="">
                                <p class="mt-2 mb-0 font-weight-normal h5">بیت کوین <span class="text-muted h6">BTC</span> </p>
                            </th>
                            <td>{{number_format(floatval($btcPrice['price']),2)}} $</td>
                            <td class="@if(strpos($btcPrice['change'], '-')===false) text-success @else text-danger @endif">{{$btcPrice['change']}}</td>
                            <td><a href="{{route('panel.exchanges.index')}}" class="btn btn-primary">خرید و فروش </a></td>
                        </tr>

                        <tr>
                            <td scope="row">3</td>
                            <th>
                                <img src="{{asset('images/crypto/ethereum.png')}}" class="float-left mr-3" height="50" alt="">
                                <p class="mt-2 mb-0 font-weight-normal h5">اتریوم کوین <span class="text-muted h6">ETH</span> </p>
                            </th>
                            <td>{{number_format(floatval($ethPrice['price']),2)}} $</td>
                            <td class="@if(strpos($ethPrice['change'], '-')===false) text-success @else text-danger @endif">{{$ethPrice['change']}}</td>
                            <td><a href="{{route('panel.exchanges.index')}}" class="btn btn-primary">خرید و فروش </a></td>
                        </tr>
                        <tr>
                            <td scope="row">4</td>
                            <th>
                                <img src="{{asset('images/crypto/monero.png')}}" class="float-left mr-3" height="50" alt="">
                                <p class="mt-2 mb-0 font-weight-normal h5">مونرو <span class="text-muted h6">XMR</span> </p>
                            </th>
                            <td>{{number_format(floatval($xmrPrice['price']),2)}} $</td>
                            <td class="@if(strpos($xmrPrice['change'], '-')===false) text-success @else text-danger @endif">{{$xmrPrice['change']}}</td>
                            <td><a href="{{route('panel.exchanges.index')}}" class="btn btn-primary">خرید و فروش </a></td>
                        </tr>
                        <tr>
                            <td scope="row">5</td>
                            <th>
                                <img src="{{asset('images/crypto/zcash.png')}}" class="float-left mr-3" height="50" alt="">
                                <p class="mt-2 mb-0 font-weight-normal h5">زی‌کش <span class="text-muted h6">ZEC</span> </p>
                            </th>
                            <td>{{number_format(floatval($zecPrice['price']),2)}} $</td>
                            <td class="@if(strpos($zecPrice['change'], '-')===false) text-success @else text-danger @endif">{{$zecPrice['change']}}</td>
                            <td><a href="{{route('panel.exchanges.index')}}" class="btn btn-primary">خرید و فروش </a></td>
                        </tr>
                    </tbody>
                    </table><!--end table-->
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
    <!-- Table End -->

    <!-- Process Start -->
    <div class="container mt-100 mt-60">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title mb-4 pb-2">
                    <h4 class="title mb-4">مراحل خرید ارز دیجیتال</h4>
                    <p class="text-muted para-desc mb-0 mx-auto">شروع به کار با <span class="text-primary font-weight-bold">صرافی آذر </span>بسیار راحت و آسان است.</p>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-md-3 col-12 mt-4 pt-2">
                <div class="text-center">
                    <div class="rounded p-4 shadow">
                        <a href="javascript:void(0)"><img src="{{asset('images/crypto/1.png')}}" height="100" class="mx-auto d-block" alt=""></a>
                    </div>

                    <div class="mt-3">
                        <h5><a href="javascript:void(0)" class="text-primary">ثبت‌نام</a></h5>
                        <p class="text-muted mb-0">در صرافی آذر ثبت‌نام کنید.</p>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-md-3 col-12 mt-4 pt-2">
                <div class="text-center">
                    <div class="rounded p-4 shadow">
                        <a href="javascript:void(0)"><img src="{{asset('images/crypto/2.png')}}" height="100" class="mx-auto d-block" alt=""></a>
                    </div>

                    <div class="mt-3">
                        <h5><a href="javascript:void(0)" class="text-primary">احراز هویت</a></h5>
                        <p class="text-muted mb-0">جهت امنیت خود، مدارک‌تان را احراز کنید.</p>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-md-3 col-12 mt-4 pt-2">
                <div class="text-center">
                    <div class="rounded p-4 shadow">
                        <a href="javascript:void(0)"><img src="{{asset('images/crypto/3.png')}}" height="100" class="mx-auto d-block" alt=""></a>
                    </div>

                    <div class="mt-3">
                        <h5><a href="javascript:void(0)" class="text-primary">خرید و فروش</a></h5>
                        <p class="text-muted mb-0">به دنیای ارزهای دیجیتال خوش آمدید!</p>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-md-3 col-12 mt-4 pt-2">
                <div class="text-center">
                    <div class="rounded p-4 shadow">
                        <a href="javascript:void(0)"><img src="{{asset('images/crypto/4.png')}}" height="100" class="mx-auto d-block" alt=""></a>
                    </div>

                    <div class="mt-3">
                        <h5><a href="javascript:void(0)" class="text-primary">سرمایه‌گذاری و خدمات مالی</a></h5>
                        <p class="text-muted mb-0">خدمات انحصاری صرافی آذر را تجربه کنید!</p>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
    <!-- Process End -->
</section><!--end section-->
<!-- Section END -->

<!-- Counter Start -->
<section class="section-two bg-primary">
    <div class="container">
        <div class="row" id="counter">
            <div class="col-md-4">
                <div class="counter-box text-center">
                    <h2 class="mb-0 mt-3 display-4 text-white"><span class="counter-value" data-count="{{\App\Models\Exchange::all()->count()}}">0</span></h2>
                    <h5 class="counter-head text-light">سفارش موفق</h5>
                </div><!--end counter box-->
            </div>

            <div class="col-md-4 mt-4 pt-2 mt-sm-0 pt-sm-0">
                <div class="counter-box text-center">
                    <h2 class="mb-0 mt-3 display-4 text-white"><span class="counter-value" data-count="{{\App\Models\User::all()->count()}}">0</span></h2>
                    <h5 class="counter-head text-light">مشتری</h5>
                </div><!--end counter box-->
            </div>

            <div class="col-md-4 mt-4 pt-2 mt-sm-0 pt-sm-0">
                <div class="counter-box text-center">
                    <h2 class="mb-0 mt-3 display-4 text-white"><span class="counter-value" data-count="{{\App\Models\Transaction::all()->count()}}">0</span></h2>
                    <h5 class="counter-head text-light">تراکنش موفق</h5>
                </div><!--end counter box-->
            </div>
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- Counter End -->

<!-- Section start -->
<section class="section">
    <!-- Crypto Portfolio end -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title mb-4 pb-2">
                    <h4 class="title mb-4">صرافی آذر در هر مکان و هر زمان در دستان شماست!</h4>
                    <p class="text-muted para-desc mb-0 mx-auto">تجربه کاربری با <span class="text-primary font-weight-bold">صرافی آذر </span> که از تکنولوژی‌های روز دنیا جهت سرعت و کیفیت خدمات خود استفاده می‌کند، یک تجربه متفاوت است.</p>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-12 mt-4 pt-2">
                <img src="{{asset('images/crypto/portfolio.png')}}" class="img-fluid mx-auto d-block" alt="">
            </div><!--end col-->

            <div class="col-md-4 col-12 mt-5 pt-md-3">
                <div class="features text-center">
                    <div class="image position-relative d-inline-block">
                        <img src="{{asset('images/icon/report.svg')}}" alt="">
                    </div>

                    <div class="content mt-4">
                        <h4 class="title-2">رشد سرمایه‌های ارزی شما</h4>
                        <p class="text-muted">با خرید و فروش و نگهداری ارزهای دیجیتال در طول زمان سرمایه شما چندین برابر خواهد شد.</p>
                        <a href="javascript:void(0)" class="text-primary">مطالعه بیشتر <i class="mdi mdi-chevron-right"></i></a>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-md-4 col-12 mt-5 pt-md-3">
                <div class="features text-center">
                    <div class="image position-relative d-inline-block">
                        <img src="{{asset('images/icon/marketing.svg')}}" alt="">
                    </div>

                    <div class="content mt-4">
                        <h4 class="title-2">معاملات با ارزهای دیجیتال</h4>
                        <p class="text-muted">در بازارهای مالی مختلف با اعتبار ارزهای دیجیتال خود معامله کنید.</p>
                        <a href="javascript:void(0)" class="text-primary">مطالعه بیشتر <i class="mdi mdi-chevron-right"></i></a>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-md-4 col-12 mt-5 pt-md-3">
                <div class="features text-center">
                    <div class="image position-relative d-inline-block">
                        <img src="{{asset('images/icon/currency.svg')}}" alt="">
                    </div>

                    <div class="content mt-4">
                        <h4 class="title-2">انتقال پول</h4>
                        <p class="text-muted">توسط ارزهای دیجیتال و پلتفرم صرافی آذر، همیشه و هرجا برای دوستان و آشنایان خود پول انتقال دهید.</p>
                        <a href="javascript:void(0)" class="text-primary">مطالعه بیشتر <i class="mdi mdi-chevron-right"></i></a>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
    <!-- Crypto Portfolio end -->

    <!-- Rate Start -->
    <div class="container mt-100 mt-60">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-6 col-12">
                <div class="p-4 text-center rounded bg-light shadow">
                    <h4 class="mb-0"><span class="text-warning">BTC 1</span> = 55,929.30</h4>
                </div>

                <div class="mt-4 pt-2 text-center">
                    <a href="javascript:void(0);"><img src="{{asset('images/crypto/bitcoin.png')}}" class="img-fluid avatar avatar-small m-2 p-2 rounded-pill shadow" data-toggle="tooltip" data-placement="top" title="Bitcoin" alt=""></a>
                    <a href="javascript:void(0);"><img src="{{asset('images/crypto/coinye.png')}}" class="img-fluid avatar avatar-small m-2 p-2 rounded-pill shadow" data-toggle="tooltip" data-placement="top" title="Coinye" alt=""></a>
                    <a href="javascript:void(0);"><img src="{{asset('images/crypto/ethereum.png')}}" class="img-fluid avatar avatar-small m-2 p-2 rounded-pill shadow" data-toggle="tooltip" data-placement="top" title="Ethereum" alt=""></a>
                    <a href="javascript:void(0);"><img src="{{asset('images/crypto/litecoin.png')}}" class="img-fluid avatar avatar-small m-2 p-2 rounded-pill shadow" data-toggle="tooltip" data-placement="top" title="Litecoin" alt=""></a>
                    <a href="javascript:void(0);"><img src="{{asset('images/crypto/monero.png')}}" class="img-fluid avatar avatar-small m-2 p-2 rounded-pill shadow" data-toggle="tooltip" data-placement="top" title="Monero" alt=""></a>
                    <a href="javascript:void(0);"><img src="{{asset('images/crypto/auroracoin.png')}}" class="img-fluid avatar avatar-small m-2 p-2 rounded-pill shadow" data-toggle="tooltip" data-placement="top" title="Auroracoin" alt=""></a>
                    <a href="javascript:void(0);"><img src="{{asset('images/crypto/potcoin.png')}}" class="img-fluid avatar avatar-small m-2 p-2 rounded-pill shadow" data-toggle="tooltip" data-placement="top" title="Potcoin" alt=""></a>
                    <a href="javascript:void(0);"><img src="{{asset('images/crypto/zcash.png')}}" class="img-fluid avatar avatar-small m-2 p-2 rounded-pill shadow" data-toggle="tooltip" data-placement="top" title="Zcash" alt=""></a>
                </div>

                <div class="mt-4 pt-2">
                    <div class="p-4 rounded shadow">
                        <h5>منتظر کسی هستید؟!</h5>
                        <div class="progress-box mt-4">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped position-relative bg-primary" style="width:67%;">
                                </div>
                            </div>
                        </div><!--end process box-->
                        <p class="text-muted mt-4 mb-0">همین الان می‌توانید رشد مالی خود را با خرید ارزهای دیجیتال شروع کنید. خرید و فروش، معاملات بازارهای مالی و سرمایه گذاری تنها قسمتی از پتانسیل ارزهای دیجیتال است.</p>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-7 col-md-6 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <div class="ml-lg-4">
                    <div class="section-title mb-4 pb-2">
                        <h4 class="title mb-4">سؤالات متداول</h4>
                        <p class="text-muted para-desc mb-0">شروع به کار با <span class="text-primary font-weight-bold">صرافی آذر </span> آسان‌تر و راحت‌تر از آن چیزی هست که فکرش را می‌کنید.</p>
                    </div>
                    <div class="faq-content mt-4">
                        <div class="accordion" id="accordionExample">
                            <div class="card border rounded shadow mb-2">
                                <a data-toggle="collapse" href="#collapseOne" class="faq position-relative" aria-expanded="true" aria-controls="collapseOne">
                                    <div class="card-header bg-light p-3" id="headingOne">
                                        <h4 class="title mb-0 faq-question"> ارز دیجیتالی چگونه درآمد کسب می کند؟ </h4>
                                    </div>
                                </a>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p class="text-muted mb-0 faq-ans">ارزهای دیجیتال مانند ارزهای کشورهای مختلف نوسان قیمت و رشد ارزش دارند. از دیگر سوی شما با ارزهای دیجیتال امکان معامله در بازارهای مالی را دارید. هم چنین می‌توانید در پلتفرم‌های مطمین و رسمی سرمایه گذاری کنید.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card border rounded shadow mb-2">
                                <a data-toggle="collapse" href="#collapseTwo" class="faq position-relative collapsed" aria-expanded="false" aria-controls="collapseTwo">
                                    <div class="card-header bg-light p-3" id="headingTwo">
                                        <h4 class="title mb-0 faq-question"> آیا می توانم به قیمتهایی که نشان می دهید اعتماد کنم؟ </h4>
                                    </div>
                                </a>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p class="text-muted mb-0 faq-ans">بله، ما در صرافی آذر قیمت‌ها را از مراجع جهانی و بصورت زنده دریافت و نمایش می‌دهیم. پس خیالتان راحت باشه قیمت‌ها واقعی هستند.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card border rounded shadow mb-2">
                                <a data-toggle="collapse" href="#collapseThree" class="faq position-relative collapsed" aria-expanded="false" aria-controls="collapseThree">
                                    <div class="card-header bg-light p-3" id="headingfive">
                                        <h4 class="title mb-0 faq-question"> آیا فقط باید مستقیماً از فروشندگان خریداری کنم؟ </h4>
                                    </div>
                                </a>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingfive" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p class="text-muted mb-0 faq-ans">بله، صرافی آذر یک واسطه بین خریداران و فروشندگان ارزهای دیجیتال هست پس برای خرید و فروش بایستی از مشتریان و شرکت‌های دیگر اقدام کنید.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card rounded shadow mb-0">
                                <a data-toggle="collapse" href="#collapsefive" class="faq position-relative collapsed" aria-expanded="false" aria-controls="collapsefive">
                                    <div class="card-header bg-light p-3" id="headingfive">
                                        <h4 class="title mb-0 faq-question"> چرا سایت صرافی آذر اینماد ندارد؟ </h4>
                                    </div>
                                </a>
                                <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p class="text-muted mb-0 faq-ans">بدلیل خلا قانونی و عدم تدویت کامل و شفاف قوانین این حوزه، مرکز توسعه تجارت الکترونیکی وزارت صمت از ارایه اینماد به سایت‌های حوزه ارزهای دیجیتال اجتناب می‌کند.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div><!--end container-->
    <!-- Rate End -->

</section><!--end section-->
<!-- Section End -->

@endsection
