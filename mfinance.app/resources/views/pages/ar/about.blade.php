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
                            <h4 class="page_title">معلومات عنا</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-bottom-30">
                                    <li class="breadcrumb-item"><a href="{{route('index')}}">الصفحة الرئيسية</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">معلومات عنا</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div><!-- ends: .row -->
            </div>
        </section><!-- ends: .breadcrumb_area -->
        <section class="about-links">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="d-flex justify-content-center">
                            <li><a href="#" class="active">معلومات عنا</a></li>
                            <li><a href="#">تاريخنا</a></li>
                            <li><a href="#">قيمنا</a></li>
                            <li><a href="#">سلوك العمل</a></li>
                            <li><a href="#">عملائنا</a></li>
                            <li><a href="#">مواقعنا</a></li>
                            <li><a href="#">قصة نجاح</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section><!-- ends: .about-links -->
        <section class="section-padding">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 margin-md-60">
                        <div class="m-bottom-35">
                            <div class="divider divider-simple text-left">
                                <h2 class="m-bottom-20">نبذة عن الشركة</h2>
                            </div>
                        </div>
                        <p>تظهر الأبحاث أن متوسط ​​الكتابات هو ليوس quod ii qua legunt saepius. كلاريتاس
                            إستراتيجية العمل الديناميكي ، إجراء تغييرات مستمرة
                            saepius clary tyitas Investig atifonesw. tionem consu etudium.<br> التحقيق في الشياطين تتأرجح
                            runt lectores legere liusry awquod he legunt saepius clary tyitas Investig atifonesw.</p>
                        <button type="button" class="btn btn-secondary btn-icon icon-left m-top-30"><i class="la la-file"></i> كتيب شركة
                        </button>
                    </div><!-- ends: .col-lg-5 -->
                    <div class="col-lg-6 offset-lg-1">
                        <div class="video-single">
                            <figure>
                                <div class="v_img">
                                    <img src="{{asset('front/img/simg-2.jpg')}}" alt="" class="rounded">
                                </div>
                                <figcaption class="d-flex justify-content-center align-items-center shape-wrapper img-shape-two">
                                    <a href="https://www.youtube.com/watch?v=omaTcIbwt9c" class="video-iframe play-btn play-btn--lg play-btn--primary"><img src="{{asset('front/img/svg/play-btn.svg')}}" alt="" class="svg"></a>
                                </figcaption>
                            </figure>
                        </div><!-- ends: .video-single -->
                    </div><!-- ends: .col-lg-6 -->
                </div><!-- ends: .row -->
            </div>
        </section><!-- ends: section -->
        <div class="counter counter--7 biz_overlay overlay--primary">
            <div class="bg_image_holder"><img src="{{asset('front/img/cbg5.jpg')}}" alt=""></div>
            <div class="container content_above">
                <div class="row align-items-center">
                    <div class="col-md-5 margin-md-60">
                        <div class="counter_left_content">
                            <h4>الشخصيات الرئيسية</h4>
                            <p>تظهر التحقيقات محاضرات متوسطه ليوس quod ii qua legunt saepius. كلارياس
                                est
                                etiam pro cessus dynamicus، qui Sequitur mutaety consu etudium
                                التحقيق في الشياطين تتأرجح.</p>
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-1">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="counter_single">
                                    <p class="value count_up">520</p>
                                    <p class="title">الإيرادات بالدولار الأمريكي</p>
                                </div><!-- end: .counter_single -->
                            </div>
                            <div class="col-sm-6">
                                <div class="counter_single">
                                    <p class="value count_up">478</p>
                                    <p class="title">الأصول بالدولار الأمريكي</p>
                                </div><!-- end: .counter_single -->
                            </div>
                            <div class="col-sm-6">
                                <div class="counter_single">
                                    <p class="value count_up">980</p>
                                    <p class="title">الموظفين</p>
                                </div><!-- end: .counter_single -->
                            </div>
                            <div class="col-sm-6">
                                <div class="counter_single">
                                    <p class="value count_up">257</p>
                                    <p class="title">صافي الدخل بالدولار الأمريكي</p>
                                </div><!-- end: .counter_single -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- ends: .counter -->
        <section class="section-bg p-top-100 p-bottom-110">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 margin-md-60">
                        <div class="m-bottom-30">
                            <div class="divider divider-simple text-left">
                                <h2 class="m-bottom-20">مهمة تيزارا</h2>
                            </div>
                        </div>
                        <p>تظهر الأبحاث متوسط ​​المحاضرات المكتوبة بخط اليد. كلارياس كيست
                            تغيير البيانات واستهلاكها. التحقيق في الشياطين تتأرجح
                            huerunt lectores legere liusry. تظهر التحقيقات متوسط.</p>
                        <div class="m-top-30">
                            <ul class="arrow--list2">
                                <li class="list-item arrow-list5 d-flex align-content-center color-dark"><span><i class="la la-angle-right"></i></span> التركيز على العميل</li>
                                <li class="list-item arrow-list5 d-flex align-content-center color-dark"><span><i class="la la-angle-right"></i></span> قيادة</li>
                                <li class="list-item arrow-list5 d-flex align-content-center color-dark"><span><i class="la la-angle-right"></i></span> التميز في التنفيذ</li>
                                <li class="list-item arrow-list5 d-flex align-content-center color-dark"><span><i class="la la-angle-right"></i></span> طموح</li>
                            </ul>
                        </div>
                    </div><!-- ends: .col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="m-bottom-30">
                            <div class="divider divider-simple text-left">
                                <h2 class="m-bottom-20">Tizara Vision</h2>
                            </div>
                        </div>
                        <p>تظهر الأبحاث متوسط ​​المحاضرات المكتوبة بخط اليد. كلارياس كيست
                            تغيير البيانات واستهلاكها. التحقيق في الشياطين تتأرجح
                            huerunt lectores legere liusry. تظهر التحقيقات متوسط.</p>
                        <div class="m-top-30">
                            <ul class="arrow--list2">
                                <li class="list-item arrow-list5 d-flex align-content-center color-dark"><span><i class="la la-angle-right"></i></span> التركيز على العميل</li>
                                <li class="list-item arrow-list5 d-flex align-content-center color-dark"><span><i class="la la-angle-right"></i></span> قيادة</li>
                                <li class="list-item arrow-list5 d-flex align-content-center color-dark"><span><i class="la la-angle-right"></i></span> التميز في التنفيذ</li>
                                <li class="list-item arrow-list5 d-flex align-content-center color-dark"><span><i class="la la-angle-right"></i></span> طموح</li>
                            </ul>
                        </div>
                    </div><!-- ends: .col-lg-6 -->
                </div>
            </div>
        </section><!-- ends: section -->
        <section class="p-top-100 p-bottom-40">
            <div class="m-bottom-55">
                <div class="divider text-center m-bottom-50">
                    <h2 class="color-dark m-0">لماذا أخترتنا</h2>
                </div>
            </div>
            <div class="icon-boxes icon-box--six">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="icon-box-four d-flex">
                                <div class="box-icon">
                                    <span class="icon-square-sm"><i class="la la-thumbs-up"></i></span>
                                </div>
                                <div class="box-content">
                                    <h6>أفكار قيّمة</h6>
                                    <p>التحقيق في الشياطين تتعامل مع الشياطين ليغري ليروس quod legunt saepius claritas est.</p>
                                </div>
                            </div><!-- ends: .icon-box -->
                        </div><!-- ends: .col-lg-4 -->
                        <div class="col-lg-4 col-md-6">
                            <div class="icon-box-four d-flex">
                                <div class="box-icon">
                                    <span class="icon-square-sm"><i class="la la-bar-chart"></i></span>
                                </div>
                                <div class="box-content">
                                    <h6>خبرة صناعية</h6>
                                    <p>التحقيق في الشياطين تتعامل مع الشياطين ليغري ليروس quod legunt saepius claritas est.</p>
                                </div>
                            </div><!-- ends: .icon-box -->
                        </div><!-- ends: .col-lg-4 -->
                        <div class="col-lg-4 col-md-6">
                            <div class="icon-box-four d-flex">
                                <div class="box-icon">
                                    <span class="icon-square-sm"><i class="la la-money"></i></span>
                                </div>
                                <div class="box-content">
                                    <h6>صديقة للميزانية</h6>
                                    <p>التحقيق في الشياطين تتعامل مع الشياطين ليغري ليروس quod legunt saepius claritas est.</p>
                                </div>
                            </div><!-- ends: .icon-box -->
                        </div><!-- ends: .col-lg-4 -->
                        <div class="col-lg-4 col-md-6">
                            <div class="icon-box-four d-flex">
                                <div class="box-icon">
                                    <span class="icon-square-sm"><i class="la la-pencil-square"></i></span>
                                </div>
                                <div class="box-content">
                                    <h6>التخطيط الاستثماري</h6>
                                    <p>التحقيق في الشياطين تتعامل مع الشياطين ليغري ليروس quod legunt saepius claritas est.</p>
                                </div>
                            </div><!-- ends: .icon-box -->
                        </div><!-- ends: .col-lg-4 -->
                        <div class="col-lg-4 col-md-6">
                            <div class="icon-box-four d-flex">
                                <div class="box-icon">
                                    <span class="icon-square-sm"><i class="la la-level-up"></i></span>
                                </div>
                                <div class="box-content">
                                    <h6>ازدهار العمل</h6>
                                    <p>التحقيق في الشياطين تتعامل مع الشياطين ليغري ليروس quod legunt saepius claritas est.</p>
                                </div>
                            </div><!-- ends: .icon-box -->
                        </div><!-- ends: .col-lg-4 -->
                        <div class="col-lg-4 col-md-6">
                            <div class="icon-box-four d-flex">
                                <div class="box-icon">
                                    <span class="icon-square-sm"><i class="la la-lightbulb-o"></i></span>
                                </div>
                                <div class="box-content">
                                    <h6>التخطيط المالي</h6>
                                    <p>التحقيق في الشياطين تتعامل مع الشياطين ليغري ليروس quod legunt saepius claritas est.</p>
                                </div>
                            </div><!-- ends: .icon-box -->
                        </div><!-- ends: .col-lg-4 -->
                    </div><!-- ends: .row -->
                </div>
            </div><!-- ends: .icon-boxes -->
        </section><!-- ends: section -->
        <div class="section-split2 p-top-100 p-bottom-105 section-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 margin-md-60">
                        <div class="m-bottom-35">
                            <div class="divider text-left">
                                <h2>جوائز تيزارا</h2>
                                <p class="mx-auto">تُظهِر التحقيقات المحاضرات المتوسطة التي يجب إجراؤها ليوس quod waqua legunt saepius vlarias est etiam proessu.</p>
                            </div>
                        </div>
                        <div class="logo-carousel-two owl-carousel">
                            <div class="carousel-single">
                                <div class="logo-box">
                                    <img src="{{asset('front/img/cl15.png')}}" alt="">
                                </div><!-- ends: .logo-box -->
                                <div class="logo-box">
                                    <img src="{{asset('front/img/cl15.png')}}" alt="">
                                </div><!-- ends: .logo-box -->
                            </div><!-- end: .carousel-single -->
                            <div class="carousel-single">
                                <div class="logo-box">
                                    <img src="{{asset('front/img/cl16.png')}}" alt="">
                                </div><!-- ends: .logo-box -->
                                <div class="logo-box">
                                    <img src="{{asset('front/img/cl17.png')}}" alt="">
                                </div><!-- ends: .logo-box -->
                            </div><!-- end: .carousel-single -->
                            <div class="carousel-single">
                                <div class="logo-box">
                                    <img src="{{asset('front/img/cl14.png')}}" alt="">
                                </div><!-- ends: .logo-box -->
                                <div class="logo-box">
                                    <img src="{{asset('front/img/cl15.png')}}" alt="">
                                </div><!-- ends: .logo-box -->
                            </div><!-- end: .carousel-single -->
                            <div class="carousel-single">
                                <div class="logo-box">
                                    <img src="{{asset('front/img/cl16.png')}}" alt="">
                                </div><!-- ends: .logo-box -->
                                <div class="logo-box">
                                    <img src="{{asset('front/img/cl17.png')}}" alt="">
                                </div><!-- ends: .logo-box -->
                            </div><!-- end: .carousel-single -->
                            <div class="carousel-single">
                                <div class="logo-box">
                                    <img src="{{asset('front/img/cl14.png')}}" alt="">
                                </div><!-- ends: .logo-box -->
                                <div class="logo-box">
                                    <img src="{{asset('front/img/cl15.png')}}" alt="">
                                </div><!-- ends: .logo-box -->
                            </div><!-- end: .carousel-single -->
                        </div>
                    </div><!-- ends: .col-lg-5 -->
                    <div class="col-lg-5 offset-lg-2">
                        <div class="m-bottom-35">
                            <div class="divider text-left">
                                <h2>مهارات احترافية</h2>
                                <p class="mx-auto">تُظهِر التحقيقات المحاضرات المتوسطة التي يجب إجراؤها ليوس quod waqua legunt saepius vlarias est etiam proessu.</p>
                            </div>
                        </div>
                        <div class="progress-wrapper">
                            <div class="labels d-flex justify-content-between">
                                <span>اعمال</span>
                                <span>70%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-secondary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                            </div><!-- ends: .progress -->
                        </div><!-- ends: .progress-wrapper -->
                        <div class="progress-wrapper">
                            <div class="labels d-flex justify-content-between">
                                <span>شركة كبرى</span>
                                <span>85%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-secondary" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                            </div><!-- ends: .progress -->
                        </div><!-- ends: .progress-wrapper -->
                        <div class="progress-wrapper">
                            <div class="labels d-flex justify-content-between">
                                <span>تمويل</span>
                                <span>90%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-secondary" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div><!-- ends: .progress -->
                        </div><!-- ends: .progress-wrapper -->
                        <div class="progress-wrapper">
                            <div class="labels d-flex justify-content-between">
                                <span>إستراتيجية</span>
                                <span>75%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-secondary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div><!-- ends: .progress -->
                        </div><!-- ends: .progress-wrapper -->
                    </div><!-- ends: .col-lg-5 -->
                </div><!-- ends: .row -->
            </div>
        </div><!-- ends: .section-split -->
        <section class="p-top-110">
            <div class="testimonial-carousel-six-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1">
                            <div class="testimonial-carousel-six owl-carousel">
                                <div class="carousel-single">
                                    <img src="{{asset('front/img/client6.jpg')}}" alt="" class="rounded-circle">
                                    <h5>أماندا ريتشاردز</h5>
                                    <span class="sub-text">علاقات العملاء</span>
                                    <p>الشياطين تتعامل مع lectores lectores legere lius quod ii legunt saepius clary tyitas Investig ationes demon trave rungt. يقوم الاستقصاء بتوجيه الشركات المسؤولة عن أعمالنا الأساسية. نحن نعمل بشكل منهجي لدمج مسؤولية الشركة في أعمالنا الأساسية.</p>
                                </div><!-- end: .carousel-single -->
                                <div class="carousel-single">
                                    <img src="{{asset('front/img/client6.jpg')}}" alt="" class="rounded-circle">
                                    <h5>أماندا ريتشاردز</h5>
                                    <span class="sub-text">علاقات العملاء</span>
                                    <p>الشياطين تتعامل مع lectores lectores legere lius quod ii legunt saepius clary tyitas Investig ationes demon trave rungt. يقوم الاستقصاء بتوجيه الشركات المسؤولة عن أعمالنا الأساسية. نحن نعمل بشكل منهجي لدمج مسؤولية الشركة في أعمالنا الأساسية.</p>
                                </div><!-- end: .carousel-single -->
                                <div class="carousel-single">
                                    <img src="{{asset('front/img/client6.jpg')}}" alt="" class="rounded-circle">
                                    <h5>أماندا ريتشاردز</h5>
                                    <span class="sub-text">علاقات العملاء</span>
                                    <p>الشياطين تتعامل مع lectores lectores legere lius quod ii legunt saepius clary tyitas Investig ationes demon trave rungt. يقوم الاستقصاء بتوجيه الشركات المسؤولة عن أعمالنا الأساسية. نحن نعمل بشكل منهجي لدمج مسؤولية الشركة في أعمالنا الأساسية.</p>
                                </div><!-- end: .carousel-single -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- ends: section -->
        <section class="p-top-105 p-bottom-65">
            <div class="m-bottom-40">
                <div class="divider text-center">
                    <h1>خبراء الأعمال</h1>
                    <p class="mx-auto"></p>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="team-carousel-one owl-carousel">
                            <div class="carousel-single">
                                <div class="card card-shadow card--team1">
                                    <div class="card-body text-center">
                                        <img src="{{asset('front/img/t1.jpg')}}" alt="" class="rounded-circle">
                                        <h6><a href="{{asset('front/img/team-single.html')}}">جين شيدز</a></h6>
                                        <span class="team-designation">الرئيس التنفيذي والمؤسس</span>
                                        <ul class="team-social d-flex justify-content-center">
                                            <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                                            <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href=""><i class="fab fa-twitter"></i></a></li>
                                            <li><a href=""><i class="fab fa-linkedin-in"></i></a></li>
                                        </ul>
                                    </div>
                                </div><!-- End: .card -->
                            </div><!-- ends: .carousel-single -->
                            <div class="carousel-single">
                                <div class="card card-shadow card--team1">
                                    <div class="card-body text-center">
                                        <img src="{{asset('front/img/t2.jpg')}}" alt="" class="rounded-circle">
                                        <h6><a href="team-single.html">نيك برايس</a></h6>
                                        <span class="team-designation">خبير أعمال</span>
                                        <ul class="team-social d-flex justify-content-center">
                                            <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                                            <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href=""><i class="fab fa-twitter"></i></a></li>
                                            <li><a href=""><i class="fab fa-linkedin-in"></i></a></li>
                                        </ul>
                                    </div>
                                </div><!-- End: .card -->
                            </div><!-- ends: .carousel-single -->
                            <div class="carousel-single">
                                <div class="card card-shadow card--team1">
                                    <div class="card-body text-center">
                                        <img src="{{asset('front/img/t3.jpg')}}" alt="" class="rounded-circle">
                                        <h6><a href="team-single.html">بوب اندروز</a></h6>
                                        <span class="team-designation">خبير مالي</span>
                                        <ul class="team-social d-flex justify-content-center">
                                            <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                                            <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href=""><i class="fab fa-twitter"></i></a></li>
                                            <li><a href=""><i class="fab fa-linkedin-in"></i></a></li>
                                        </ul>
                                    </div>
                                </div><!-- End: .card -->
                            </div><!-- ends: .carousel-single -->
                            <div class="carousel-single">
                                <div class="card card-shadow card--team1">
                                    <div class="card-body text-center">
                                        <img src="{{asset('front/img/t1.jpg')}}" alt="" class="rounded-circle">
                                        <h6><a href="team-single.html">جين شيدز</a></h6>
                                        <span class="team-designation">الرئيس التنفيذي والمؤسس</span>
                                        <ul class="team-social d-flex justify-content-center">
                                            <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                                            <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href=""><i class="fab fa-twitter"></i></a></li>
                                            <li><a href=""><i class="fab fa-linkedin-in"></i></a></li>
                                        </ul>
                                    </div>
                                </div><!-- End: .card -->
                            </div><!-- ends: .carousel-single -->
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- end: section --> 
            
        </div>
    </section>
@endsection