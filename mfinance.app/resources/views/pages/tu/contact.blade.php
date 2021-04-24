@extends('partials-tu.layout')

@section('content')
<section class="intro-area">
    <div class="">            
        <!-- header area -->
        @include('partials-tu.header')            
        <section class="breadcrumb_area breadcrumb2 bgimage biz_overlay">
            <div class="bg_image_holder">
                <img src="{{asset('front/img/breadbg.jpg')}}" alt="">
            </div>
            <div class="container content_above">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb_wrapper d-flex flex-column align-items-center">
                            <h4 class="page_title">İletişim</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-bottom-30">
                                    <li class="breadcrumb-item"><a href="{{SITE_URL.'/pages/tu/'}}">Ev</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">İletişim</li>
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
                                <p class="nam">Birleşik Krallık</p>
                                <p>49 Featherstone Street Londra, Birleşik Krallık +884688888800</p>
                            </div><!-- end: .adress -->
                        </div><!-- ends: .col-lg-3 -->
                        <div class="col-lg-3 col-md-6">
                            <div class="adress">
                                <img src="{{asset('front/img/gerf.png')}}" >
                                <p class="nam">Almanya</p>
                                <p>32 Neuwe Doelenstraat Amsterdam, Almanya +44 6478888400</p>
                            </div><!-- end: .adress -->
                        </div><!-- ends: .col-lg-3 -->
                        <div class="col-lg-3 col-md-6">
                            <div class="adress">
                                <img src="{{asset('front/img/engf.png')}}">
                                <p class="nam">Avustralya</p>
                                <p>96 South Park Avenue Melbourne, Avustralya +44 6478888400</p>
                            </div><!-- end: .adress -->
                        </div><!-- ends: .col-lg-3 -->
                        <div class="col-lg-3 col-md-6">
                            <div class="adress">
                                <img src="{{asset('front/img/usaf.png')}}">
                                <p class="nam">Amerika Birleşik Devletleri</p>
                                <p>49 Featherstone Street Londra, Birleşik Krallık +884688888800</p>
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
                                <h1 class="color-dark m-0">Geri Arama İsteyin</h1>
                            </div>
                            <div class="form-wrapper">
                                <form action="#">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 m-bottom-30">
                                            <input type="text" placeholder="Adınız" class="form-control" required>
                                        </div>
                                        <div class="col-lg-4 col-md-6 m-bottom-30">
                                            <input type="text" placeholder="Telefon numarası" class="form-control" required>
                                        </div>
                                        <div class="col-lg-4 m-bottom-30">
                                            <input type="email" placeholder="Eposta" class="form-control" required>
                                        </div>
                                        <div class="col-lg-12 m-bottom-20">
                                            <textarea class="form-control" rows="7" placeholder="İleti" required></textarea>
                                        </div>
                                        <div class="col-lg-12 text-center m-top-30">
                                            <button class="btn btn-primary">Şimdi talep edin</button>
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