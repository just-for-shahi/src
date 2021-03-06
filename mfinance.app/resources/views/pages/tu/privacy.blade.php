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
                            <h4 class="page_title">Gizlilik Politikas─▒</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-bottom-30">
                                    <li class="breadcrumb-item"><a href="{{SITE_URL.'/pages/tu/'}}">Ev</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Gizlilik Politikas─▒</li>
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
                                <h3>Gizlilik Politikas─▒</h3>
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
                                <p class="mb-3">Lorem Ipsum, bask─▒ ve dizgi end├╝strisinin basit bir metnidir. Lorem Ipsum, bilinmeyen bir matbaac─▒n─▒n bir dizi ├že┼čidini al─▒p bir t├╝r numune kitab─▒ yapmak i├žin kar─▒┼čt─▒rd─▒─č─▒ 1500'lerden beri end├╝strinin standart kukla metni olmu┼čtur. Sadece be┼č as─▒rd─▒r de─čil, ayn─▒ zamanda elektronik dizgiye de s─▒├žrad─▒ ve esasen de─či┼čmeden kald─▒. 1960'larda Lorem Ipsum pasajlar─▒ i├žeren Letraset sayfalar─▒n─▒n yay─▒nlanmas─▒yla ve yak─▒n zamanda Aldus PageMaker gibi Lorem Ipsum s├╝r├╝mleri de dahil olmak ├╝zere masa├╝st├╝ yay─▒nc─▒l─▒k yaz─▒l─▒mlar─▒yla pop├╝ler hale geldi.</p>
                                <p class="mb-3">Bir okuyucunun, d├╝zenine bakarken bir sayfan─▒n okunabilir i├žeri─činden rahats─▒z olaca─č─▒ uzun s├╝redir bilinen bir ger├žektir. Lorem Ipsum kullanman─▒n amac─▒, 'Buradaki i├žerik, burada i├žerik' kullanman─▒n aksine, a┼ča─č─▒ yukar─▒ normal bir harf da─č─▒l─▒m─▒na sahip olmas─▒ ve Lorem Ipsum'un bask─▒ ve dizgi end├╝strisinin basit bir metni gibi g├Âr├╝nmesini sa─člamas─▒d─▒r. Lorem Ipsum, bilinmeyen bir matbaac─▒n─▒n bir dizi ├že┼čidini al─▒p bir t├╝r numune kitab─▒ yapmak i├žin kar─▒┼čt─▒rd─▒─č─▒ 1500'lerden beri end├╝strinin standart kukla metni olmu┼čtur. Sadece be┼č as─▒rd─▒r de─čil, ayn─▒ zamanda elektronik dizgiye de s─▒├žrad─▒ ve esasen de─či┼čmeden kald─▒. 1960'larda Lorem Ipsum pasajlar─▒ i├žeren Letraset sayfalar─▒n─▒n yay─▒nlanmas─▒yla ve yak─▒n zamanda Aldus PageMaker gibi Lorem Ipsum s├╝r├╝mleri de dahil olmak ├╝zere masa├╝st├╝ yay─▒nc─▒l─▒k yaz─▒l─▒mlar─▒yla pop├╝ler hale geldi.</p>
                                <p>Lorem Ipsum, bask─▒ ve dizgi end├╝strisinin basit bir metnidir. Lorem Ipsum, bilinmeyen bir matbaac─▒n─▒n bir dizi ├že┼čidini al─▒p bir t├╝r numune kitab─▒ yapmak i├žin kar─▒┼čt─▒rd─▒─č─▒ 1500'lerden beri end├╝strinin standart kukla metni olmu┼čtur. Sadece be┼č as─▒rd─▒r de─čil, ayn─▒ zamanda elektronik dizgiye de s─▒├žrad─▒ ve esasen de─či┼čmeden kald─▒. 1960'larda Lorem Ipsum pasajlar─▒ i├žeren Letraset sayfalar─▒n─▒n yay─▒nlanmas─▒yla ve yak─▒n zamanda Aldus PageMaker gibi Lorem Ipsum s├╝r├╝mleri de dahil olmak ├╝zere masa├╝st├╝ yay─▒nc─▒l─▒k yaz─▒l─▒mlar─▒yla pop├╝ler hale geldi.</p>
                            </div>
                        </div><!-- ends: .col-lg-6 -->
                    </div>
                </div>
            </div><!-- ends: .faqs-one -->
        </section><!-- ends: .section-padding-sm -->
    </div>
</section>    
@endsection