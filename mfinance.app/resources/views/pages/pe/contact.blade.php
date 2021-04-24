@extends('partials-pe.layout')

@section('content')
<section class="intro-area">
    <div class="">            
        <!-- header area -->
        @include('partials-pe.header')            
        <section class="breadcrumb_area breadcrumb2 bgimage biz_overlay">
            <div class="bg_image_holder">
                <img src="{{asset('front/img/breadbg.jpg')}}" alt="">
            </div>
            <div class="container content_above">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb_wrapper d-flex flex-column align-items-center">
                            <h4 class="page_title">مخاطب</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-bottom-30">
                                    <li class="breadcrumb-item"><a href="{{route('index')}}">خانه</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">مخاطب</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div><!-- ends: .row -->
            </div>
        </section><!-- ends: .breadcrumb_area -->
        <section class="p-top-110 p-bottom-50">
            <div class="address-blocks">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="adress">
                                <img src="{{asset('front/img/ukf.png')}}" >
                                <p class="nam">انگلستان</p>
                                <p>49 خیابان Featherstone Street لندن ، انگلستان +88 468 888 800</p>
                            </div><!-- end: .adress -->
                        </div><!-- ends: .col-lg-3 -->
                        <div class="col-lg-3 col-md-6">
                            <div class="adress">
                                <img src="{{asset('front/img/gerf.png')}}" >
                                <p class="nam">آلمان</p>
                                <p>32 Neuwe Doelenstraat آمستردام ، آلمان +44 647 888 400</p>
                            </div><!-- end: .adress -->
                        </div><!-- ends: .col-lg-3 -->
                        <div class="col-lg-3 col-md-6">
                            <div class="adress">
                                <img src="{{asset('front/img/engf.png')}}">
                                <p class="nam">استرالیا</p>
                                <p>96 South Park Avenue ملبورن ، استرالیا +44 647 888 400</p>
                            </div><!-- end: .adress -->
                        </div><!-- ends: .col-lg-3 -->
                        <div class="col-lg-3 col-md-6">
                            <div class="adress">
                                <img src="{{asset('front/img/usaf.png')}}">
                                <p class="nam">ایالات متحده آمریکا</p>
                                <p>49 خیابان Featherstone Street لندن ، انگلستان +88 468 888 800</p>
                            </div><!-- end: .adress -->
                        </div><!-- ends: .col-lg-3 -->
                    </div>
                </div><!-- ends: .container -->
            </div><!-- ends: .address-blocks -->
        </section><!-- ends: section -->
        <section class="google_map">
            <div class="map" id="map1"></div><!-- end: .map -->
        </section><!-- ends .google_map -->
        <section class="p-top-100 p-bottom-110">
            <section class="form-wrapper contact--from5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="divider text-center m-bottom-50">
                                <h1 class="color-dark m-0">درخواست تماس بگیرید</h1>
                            </div>
                            <div class="form-wrapper">
                                <form action="#">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 m-bottom-30">
                                            <input type="text" placeholder="اسم شما" class="form-control" required>
                                        </div>
                                        <div class="col-lg-4 col-md-6 m-bottom-30">
                                            <input type="text" placeholder="شماره تلفن" class="form-control" required>
                                        </div>
                                        <div class="col-lg-4 m-bottom-30">
                                            <input type="email" placeholder="پست الکترونیک" class="form-control" required>
                                        </div>
                                        <div class="col-lg-12 m-bottom-20">
                                            <textarea class="form-control" rows="7" placeholder="پیام" required></textarea>
                                        </div>
                                        <div class="col-lg-12 text-center m-top-30">
                                            <button class="btn btn-primary">اکنون درخواست کنید</button>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- end: .form-wrapper -->
                        </div>                        
                    </div>
                </div>
            </section><!-- ends: .form-wrapper -->
        </section><!-- ends: section -->
    </div>
</section>    
@endsection