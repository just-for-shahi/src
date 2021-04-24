@extends('partials-ar.layout')

@section('content')
<section class="intro-area">
    <div class="">            
        <!-- header area -->
        @include('partials-ar.header')            
        <section class="breadcrumb_area breadcrumb2 bgimage biz_overlay">
            <div class="bg_image_holder">
                <img src="{{asset('front/img/breadbg.jpg')}}" alt="">
            </div>
            <div class="container content_above">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb_wrapper d-flex flex-column align-items-center">
                            <h4 class="page_title">التعليمات</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-bottom-30">
                                    <li class="breadcrumb-item"><a href="{{route('index')}}">الصفحة الرئيسية</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">التعليمات</li>
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
                                <h3>حول خدماتنا</h3>
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
                                                إدارة النظام البيئي الرقمي - الطريقة الجديدة لنمو شركات التأمين
                                            </a>
                                        </h6>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion_one">
                                        <div class="accordion-contents">
                                            <p>تظهر الأبحاث متوسط ​​النصوص المكتوبة بخط اليد. مؤسسة كلاريتاس
                                                etiam pro cessus dynamicus qui Sequitur mutatin onem consuetudium. مظاهرة التحقيقات
                                                متوسط ​​lectores legere me liusked quod kequa legunt saepius. كلاريتاس هي وسيلة للتشغيل.
                                                Sequitur mutatin onem consuetudium.</p>
                                        </div>
                                    </div><!-- Ends: .collapseOne -->
                                </div><!-- Ends: .accordion-single -->
                                <div class="accordion-single">
                                    <div class="accordion-heading" id="headingTwo">
                                        <h6 class="mb-0">
                                            <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                الرقمنة والتنظيم يقود أجندة تجارات
                                            </a>
                                        </h6>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion_one">
                                        <div class="accordion-contents">
                                            <p>تظهر الأبحاث متوسط ​​النصوص المكتوبة بخط اليد. مؤسسة كلاريتاس
                                                etiam pro cessus dynamicus qui Sequitur mutatin onem consuetudium. مظاهرة التحقيقات
                                                متوسط ​​lectores legere me liusked quod kequa legunt saepius. كلاريتاس هي وسيلة للتشغيل.
                                                Sequitur mutatin onem consuetudium.</p>
                                        </div>
                                    </div>
                                </div><!-- Ends: .accordion-single -->
                                <div class="accordion-single">
                                    <div class="accordion-heading" id="headingThree">
                                        <h6 class="mb-0">
                                            <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                تحويل تكنولوجيا معلومات التأمين - تمكين التغيير الرقمي
                                            </a>
                                        </h6>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion_one">
                                        <div class="accordion-contents">
                                            <p>تظهر الأبحاث متوسط ​​النصوص المكتوبة بخط اليد. مؤسسة كلاريتاس
                                                etiam pro cessus dynamicus qui Sequitur mutatin onem consuetudium. مظاهرة التحقيقات
                                                متوسط ​​lectores legere me liusked quod kequa legunt saepius. كلاريتاس هي وسيلة للتشغيل.
                                                Sequitur mutatin onem consuetudium.</p>
                                        </div>
                                    </div><!-- Ends: .collapseOne -->
                                </div><!-- Ends: .accordion-single -->
                                <div class="accordion-single">
                                    <div class="accordion-heading" id="headingFour">
                                        <h6 class="mb-0">
                                            <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                قوة القناة متعددة الاتجاهات
                                            </a>
                                        </h6>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion_one">
                                        <div class="accordion-contents">
                                            <p>تظهر الأبحاث متوسط ​​النصوص المكتوبة بخط اليد. مؤسسة كلاريتاس
                                                etiam pro cessus dynamicus qui Sequitur mutatin onem consuetudium. مظاهرة التحقيقات
                                                متوسط ​​lectores legere me liusked quod kequa legunt saepius. كلاريتاس هي وسيلة للتشغيل.
                                                Sequitur mutatin onem consuetudium.</p>
                                        </div>
                                    </div><!-- Ends: .collapseOne -->
                                </div><!-- Ends: .accordion-single -->
                                <div class="accordion-single">
                                    <div class="accordion-heading" id="headingFive">
                                        <h6 class="mb-0">
                                            <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                تحويل تكنولوجيا معلومات التأمين - تمكين التغيير الرقمي
                                            </a>
                                        </h6>
                                    </div>
                                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion_one">
                                        <div class="accordion-contents">
                                            <p>تظهر الأبحاث متوسط ​​النصوص المكتوبة بخط اليد. مؤسسة كلاريتاس
                                                etiam pro cessus dynamicus qui Sequitur mutatin onem consuetudium. مظاهرة التحقيقات
                                                متوسط ​​lectores legere me liusked quod kequa legunt saepius. كلاريتاس هي وسيلة للتشغيل.
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
                                <h3>حول التسعير لدينا</h3>
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
                                <h6>1. متى يمكننا البدء؟</h6>
                                <p>تُظهِر التحقيقات محاضرات متوسّطة من نصيبي. Clarias etiam pro cessus dynamicus.</p>
                            </div>
                        </div><!-- ends: .col-lg-6 -->
                        <div class="col-lg-6">
                            <div class="faq-single">
                                <h6>2. كيف أقوم بإجراء أبحاث السوق؟</h6>
                                <p>تُظهِر التحقيقات محاضرات متوسّطة من نصيبي. Clarias etiam pro cessus dynamicus.</p>
                            </div>
                        </div><!-- ends: .col-lg-6 -->
                        <div class="col-lg-6">
                            <div class="faq-single">
                                <h6>3. ما الذي أحتاجه لبدء البيع؟</h6>
                                <p>تُظهِر التحقيقات محاضرات متوسّطة من نصيبي. Clarias etiam pro cessus dynamicus.</p>
                            </div>
                        </div><!-- ends: .col-lg-6 -->
                        <div class="col-lg-6">
                            <div class="faq-single">
                                <h6>4. ما هي المساعدة الأخرى المتوفرة؟</h6>
                                <p>تُظهِر التحقيقات محاضرات متوسّطة من نصيبي. Clarias etiam pro cessus dynamicus.</p>
                            </div>
                        </div><!-- ends: .col-lg-6 -->
                        <div class="col-lg-6">
                            <div class="faq-single">
                                <h6>5. ما هي المساعدة الأخرى المتوفرة؟</h6>
                                <p>تُظهِر التحقيقات محاضرات متوسّطة من نصيبي. Clarias etiam pro cessus dynamicus.</p>
                            </div>
                        </div><!-- ends: .col-lg-6 -->
                        <div class="col-lg-6">
                            <div class="faq-single">
                                <h6>6. كيف أقوم بإجراء السوق؟</h6>
                                <p>تُظهِر التحقيقات محاضرات متوسّطة من نصيبي. Clarias etiam pro cessus dynamicus.</p>
                            </div>
                        </div><!-- ends: .col-lg-6 -->
                        <div class="col-lg-12 text-center m-top-20">
                            <a href="" class="btn btn-primary">المزيد من الأسئلة الشائعة</a>
                        </div>
                    </div>
                </div>
            </div><!-- ends: .faqs-one -->
        </section><!-- ends: .section-padding-sm -->        
    </div>
</section>        
@endsection