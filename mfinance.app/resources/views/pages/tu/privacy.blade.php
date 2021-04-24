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
                            <h4 class="page_title">Gizlilik Politikası</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-bottom-30">
                                    <li class="breadcrumb-item"><a href="{{SITE_URL.'/pages/tu/'}}">Ev</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Gizlilik Politikası</li>
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
                                <h3>Gizlilik Politikası</h3>
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
                                <p class="mb-3">Lorem Ipsum, baskı ve dizgi endüstrisinin basit bir metnidir. Lorem Ipsum, bilinmeyen bir matbaacının bir dizi çeşidini alıp bir tür numune kitabı yapmak için karıştırdığı 1500'lerden beri endüstrinin standart kukla metni olmuştur. Sadece beş asırdır değil, aynı zamanda elektronik dizgiye de sıçradı ve esasen değişmeden kaldı. 1960'larda Lorem Ipsum pasajları içeren Letraset sayfalarının yayınlanmasıyla ve yakın zamanda Aldus PageMaker gibi Lorem Ipsum sürümleri de dahil olmak üzere masaüstü yayıncılık yazılımlarıyla popüler hale geldi.</p>
                                <p class="mb-3">Bir okuyucunun, düzenine bakarken bir sayfanın okunabilir içeriğinden rahatsız olacağı uzun süredir bilinen bir gerçektir. Lorem Ipsum kullanmanın amacı, 'Buradaki içerik, burada içerik' kullanmanın aksine, aşağı yukarı normal bir harf dağılımına sahip olması ve Lorem Ipsum'un baskı ve dizgi endüstrisinin basit bir metni gibi görünmesini sağlamasıdır. Lorem Ipsum, bilinmeyen bir matbaacının bir dizi çeşidini alıp bir tür numune kitabı yapmak için karıştırdığı 1500'lerden beri endüstrinin standart kukla metni olmuştur. Sadece beş asırdır değil, aynı zamanda elektronik dizgiye de sıçradı ve esasen değişmeden kaldı. 1960'larda Lorem Ipsum pasajları içeren Letraset sayfalarının yayınlanmasıyla ve yakın zamanda Aldus PageMaker gibi Lorem Ipsum sürümleri de dahil olmak üzere masaüstü yayıncılık yazılımlarıyla popüler hale geldi.</p>
                                <p>Lorem Ipsum, baskı ve dizgi endüstrisinin basit bir metnidir. Lorem Ipsum, bilinmeyen bir matbaacının bir dizi çeşidini alıp bir tür numune kitabı yapmak için karıştırdığı 1500'lerden beri endüstrinin standart kukla metni olmuştur. Sadece beş asırdır değil, aynı zamanda elektronik dizgiye de sıçradı ve esasen değişmeden kaldı. 1960'larda Lorem Ipsum pasajları içeren Letraset sayfalarının yayınlanmasıyla ve yakın zamanda Aldus PageMaker gibi Lorem Ipsum sürümleri de dahil olmak üzere masaüstü yayıncılık yazılımlarıyla popüler hale geldi.</p>
                            </div>
                        </div><!-- ends: .col-lg-6 -->
                    </div>
                </div>
            </div><!-- ends: .faqs-one -->
        </section><!-- ends: .section-padding-sm -->
    </div>
</section>    
@endsection