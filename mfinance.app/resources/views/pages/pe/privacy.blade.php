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
                            <h4 class="page_title">سیاست حفظ حریم خصوصی</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-bottom-30">
                                    <li class="breadcrumb-item"><a href="{{route('index')}}">خانه</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">سیاست حفظ حریم خصوصی</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div><!-- ends: .row -->
            </div>
        </section><!-- ends: .breadcrumb_area -->
        <section class="py-5 mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-5">
                            <div class="divider divider-simple text-center">
                                <h3>سیاست حفظ حریم خصوصی</h3>
                            </div>
                        </div>
                    </div><!-- ends: .col-lg-12 -->
                </div>
            </div>
            <div class="faqs-one">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="faq-single text-center">
                                <!-- <h6>Lorem Ipsum is simply dummy</h6> -->
                                <p class="mb-3">Lorem Ipsum به سادگی متن ساختگی صنعت چاپ و حروفچینی است. لورم ایپسوم از سال 1500 به بعد ، متن ساختگی استاندارد صنعت بوده است ، زمانی که چاپگر ناشناخته یک نوع آشپزخانه را انتخاب کرد و آنرا مخلوط کرد تا یک کتاب نمونه نمونه بسازد. این نه تنها از پنج قرن ، بلکه از جهش به حروفچینی الکترونیکی نیز جان سالم به در برده است و اساساً بدون تغییر باقی مانده است. این در دهه 1960 با انتشار ورقهای Letraset حاوی مقادیر Lorem Ipsum و اخیراً با نرم افزار انتشار دسک تاپ مانند Aldus PageMaker شامل نسخه های Lorem Ipsum ، رایج شد.</p>
                                <p class="mb-3">این یک واقعیت ثابت شده طولانی است که خواننده هنگام مشاهده صفحه آن از محتوای خواندنی آن منحرف می شود. نکته ای که در استفاده از لورم ایپسوم وجود دارد این است که توزیع حروف کم و بیش عادی دارد ، در مقابل استفاده از "محتوا در اینجا ، محتوای اینجا" ، و باعث می شود به نظر می رسد لورم ایپسوم متن ساختگی صنعت چاپ و حروفچینی است. لورم ایپسوم از سال 1500 به بعد ، متن ساختگی استاندارد صنعت بوده است ، زمانی که چاپگر ناشناخته یک نوع آشپزخانه را انتخاب کرد و آنرا مخلوط کرد تا یک کتاب نمونه نمونه بسازد. این نه تنها از پنج قرن ، بلکه از جهش به حروفچینی الکترونیکی نیز جان سالم به در برده است و اساساً بدون تغییر باقی مانده است. این در دهه 1960 با انتشار ورقهای Letraset حاوی مقادیر Lorem Ipsum و اخیراً با نرم افزار انتشار دسک تاپ مانند Aldus PageMaker شامل نسخه های Lorem Ipsum ، رایج شد.</p>
                                <p>Lorem Ipsum به سادگی متن ساختگی صنعت چاپ و حروفچینی است. لورم ایپسوم از سال 1500 به بعد ، متن ساختگی استاندارد صنعت بوده است ، زمانی که چاپگر ناشناخته یک نوع آشپزخانه را انتخاب کرد و آنرا مخلوط کرد تا یک کتاب نمونه نمونه بسازد. این نه تنها از پنج قرن ، بلکه از جهش به حروفچینی الکترونیکی نیز جان سالم به در برده است و اساساً بدون تغییر باقی مانده است. این در دهه 1960 با انتشار ورقهای Letraset حاوی مقادیر Lorem Ipsum و اخیراً با نرم افزار انتشار دسک تاپ مانند Aldus PageMaker شامل نسخه های Lorem Ipsum ، رایج شد.</p>
                            </div>
                        </div><!-- ends: .col-lg-6 -->
                    </div>
                </div>
            </div><!-- ends: .faqs-one -->
        </section><!-- ends: .section-padding-sm -->
    </div>
</section>    
@endsection