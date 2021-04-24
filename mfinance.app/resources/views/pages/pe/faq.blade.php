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
                            <h4 class="page_title">پرسش و پاسخ</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-bottom-30">
                                    <li class="breadcrumb-item"><a href="{{route('index')}}">خانه</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">پرسش و پاسخ</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div><!-- ends: .row -->
            </div>
        </section><!-- ends: .breadcrumb_area -->
        <section class="sectionbg p-top-100 p-bottom-110">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-5">
                            <div class="divider divider-simple text-center">
                                <h3>درباره خدمات ما</h3>
                            </div>
                        </div>
                    </div><!-- ends: .col-lg-12 -->
                </div>
            </div>
            <div class="accordion-styles accordion--one">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="accordion accordion_one" id="accordion_one">
                                <div class="accordion-single">
                                    <div class="accordion-heading" id="headingOne">
                                        <h6 class="mb-0">
                                            <a href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                مدیریت اکوسیستم دیجیتال - راهی جدید برای رشد بیمه ها
                                            </a>
                                        </h6>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion_one">
                                        <div class="accordion-contents">
                                            <p>پژوهشگران تظاهرات سخنرانان averun legere melius quod kequa legunt saepius. Claritas est
                                                etiam pro cessus dynamicus qui sequitur mutatin onem consuetudium. تحقیقات نشان می دهد
                                                سخنرانان محرمانه به من اجازه می دهند تا از ququa legunt saepius استفاده كنند. Claritas est etiam pro cessus.
                                                Sequitur mutatin onem consuetudium.</p>
                                        </div>
                                    </div><!-- Ends: .collapseOne -->
                                </div><!-- Ends: .accordion-single -->
                                <div class="accordion-single">
                                    <div class="accordion-heading" id="headingTwo">
                                        <h6 class="mb-0">
                                            <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                دیجیتالی سازی و تنظیم مقررات دستورالعمل تجارت را به پیش می برد
                                            </a>
                                        </h6>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion_one">
                                        <div class="accordion-contents">
                                            <p>Investiga tiones demonstr averun lectores legere melius quod kequa legunt saepius. Claritas est
                                                etiam pro cessus dynamicus qui sequitur mutatin onem consuetudium. Investiga tiones demonstr
                                                averunt lectores legere me liusked quod kequa legunt saepius. Claritas est etiam pro cessus.
                                                Sequitur mutatin onem consuetudium.</p>
                                        </div>
                                    </div>
                                </div><!-- Ends: .accordion-single -->
                                <div class="accordion-single">
                                    <div class="accordion-heading" id="headingThree">
                                        <h6 class="mb-0">
                                            <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                تحول فناوری اطلاعات بیمه - امکان تغییر دیجیتال
                                            </a>
                                        </h6>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion_one">
                                        <div class="accordion-contents">
                                            <p>پژوهشگران تظاهرات سخنرانان averun legere melius quod kequa legunt saepius. Claritas est
                                                etiam pro cessus dynamicus qui sequitur mutatin onem consuetudium. تحقیقات نشان می دهد
                                                سخنرانان محرمانه به من اجازه می دهند تا از ququa legunt saepius استفاده كنند. Claritas est etiam pro cessus.
                                                Sequitur mutatin onem consuetudium.</p>
                                        </div>
                                    </div><!-- Ends: .collapseOne -->
                                </div><!-- Ends: .accordion-single -->
                                <div class="accordion-single">
                                    <div class="accordion-heading" id="headingFour">
                                        <h6 class="mb-0">
                                            <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                قدرت Omnichannel
                                            </a>
                                        </h6>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion_one">
                                        <div class="accordion-contents">
                                            <p>پژوهشگران تظاهرات سخنرانان averun legere melius quod kequa legunt saepius. Claritas est
                                                etiam pro cessus dynamicus qui sequitur mutatin onem consuetudium. تحقیقات نشان می دهد
                                                سخنرانان محرمانه به من اجازه می دهند تا از ququa legunt saepius استفاده كنند. Claritas est etiam pro cessus.
                                                Sequitur mutatin onem consuetudium.</p>
                                        </div>
                                    </div><!-- Ends: .collapseOne -->
                                </div><!-- Ends: .accordion-single -->
                                <div class="accordion-single">
                                    <div class="accordion-heading" id="headingFive">
                                        <h6 class="mb-0">
                                            <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                تحول فناوری اطلاعات بیمه - امکان تغییر دیجیتال
                                            </a>
                                        </h6>
                                    </div>
                                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion_one">
                                        <div class="accordion-contents">
                                            <p>پژوهشگران تظاهرات سخنرانان averun legere melius quod kequa legunt saepius. Claritas est
                                                etiam pro cessus dynamicus qui sequitur mutatin onem consuetudium. تحقیقات نشان می دهد
                                                سخنرانان محرمانه به من اجازه می دهند تا از ququa legunt saepius استفاده كنند. Claritas est etiam pro cessus.
                                                Sequitur mutatin onem consuetudium.</p>
                                        </div>
                                    </div><!-- Ends: .collapseOne -->
                                </div><!-- Ends: .accordion-single -->
                            </div><!-- Ends: #accordion_one -->
                        </div>
                    </div>
                </div>
            </div><!-- Ends: accordion-styles -->
        </section><!-- ends: .section-padding -->
        <section class="p-top-100 p-bottom-110">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-5">
                            <div class="divider divider-simple text-center">
                                <h3>درباره قیمت گذاری ما</h3>
                            </div>
                        </div>
                    </div><!-- ends: .col-lg-12 -->
                </div>
            </div>
            <div class="faqs-one">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="faq-single">
                                <h6>1. چه زمانی می توانیم شروع کنیم؟</h6>
                                <p>تحقیق در زمینه سخنرانی سخنرانان متبحر به من اجازه می دهد تا از نظر قانونی حمایت کند. Clarias etiam pro cessus dynamicus.</p>
                            </div>
                        </div><!-- ends: .col-lg-6 -->
                        <div class="col-lg-6">
                            <div class="faq-single">
                                <h6>2. چگونه می توانم تحقیقات بازار را انجام دهم؟</h6>
                                <p>تحقیق در زمینه سخنرانی سخنرانان متبحر به من اجازه می دهد تا از نظر قانونی حمایت کند. Clarias etiam pro cessus dynamicus.</p>
                            </div>
                        </div><!-- ends: .col-lg-6 -->
                        <div class="col-lg-6">
                            <div class="faq-single">
                                <h6>3. برای شروع فروش به چه چیزهایی نیاز دارم؟</h6>
                                <p>تحقیق در زمینه سخنرانی سخنرانان متبحر به من اجازه می دهد تا از نظر قانونی حمایت کند. Clarias etiam pro cessus dynamicus.</p>
                            </div>
                        </div><!-- ends: .col-lg-6 -->
                        <div class="col-lg-6">
                            <div class="faq-single">
                                <h6>4. چه کمک دیگری در دسترس است؟</h6>
                                <p>تحقیق در زمینه سخنرانی سخنرانان متبحر به من اجازه می دهد تا از نظر قانونی حمایت کند. Clarias etiam pro cessus dynamicus.</p>
                            </div>
                        </div><!-- ends: .col-lg-6 -->
                        <div class="col-lg-6">
                            <div class="faq-single">
                                <h6>5. چه کمک دیگری در دسترس است؟</h6>
                                <p>تحقیق در زمینه سخنرانی سخنرانان متبحر به من اجازه می دهد تا از نظر قانونی حمایت کند. Clarias etiam pro cessus dynamicus.</p>
                            </div>
                        </div><!-- ends: .col-lg-6 -->
                        <div class="col-lg-6">
                            <div class="faq-single">
                                <h6>6. چگونه می توانم بازار را انجام دهم؟</h6>
                                <p>تحقیق در زمینه سخنرانی سخنرانان متبحر به من اجازه می دهد تا از نظر قانونی حمایت کند. Clarias etiam pro cessus dynamicus.</p>
                            </div>
                        </div><!-- ends: .col-lg-6 -->
                        <div class="col-lg-12 text-center m-top-20">
                            <a href="" class="btn btn-primary">س FAالات متداول بیشتر</a>
                        </div>
                    </div>
                </div>
            </div><!-- ends: .faqs-one -->
        </section><!-- ends: .section-padding-sm -->     
    </div>
</section>    
@endsection