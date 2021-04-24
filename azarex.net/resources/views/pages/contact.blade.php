@extends('partials.front')
@section('wrapper')
    <section class="bg-half bg-light">
        <div class="home-center">
            <div class="home-desc-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 text-center">
                            <div class="page-next-level">
                                <h4 class="title">تماس با ما</h4>
                                <ul class="page-next d-inline-block bg-white shadow p-2 pl-4 pr-4 rounded mb-0">
                                    <li><a href="{{route('index')}}" class="text-uppercase font-weight-bold text-dark">صرافی آذر</a></li>
                                    <li>
                                        <span class="text-uppercase text-primary font-weight-bold">تماس با ما</span>
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
    <section class="section pb-0">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="contact-detail text-center">
                        <div class="icon">
                            <img src="{{asset('images/icon/bitcoin.svg')}}" alt="">
                        </div>
                        <div class="content mt-3">
                            <h4 class="title font-weight-bold">تلفن</h4>
                            <p class="text-muted">پذیرای صدای گرم‌تان هستیم!</p>
                            <a href="tel:+982128427878" class="text-primary">۰۲۱-۲۸۴۲-۷۸۷۸</a>
                        </div>
                    </div>
                </div><!--end col-->

                <div class="col-md-4 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="contact-detail text-center">
                        <div class="icon">
                            <img src="{{asset('images/icon/Email.svg')}}" alt="">
                        </div>
                        <div class="content mt-3">
                            <h4 class="title font-weight-bold">ایمیل</h4>
                            <p class="text-muted">۲۴ ساعت شبانه روز پاسخگوی ایمیل‌تان هستیم!</p>
                            <a href="mailto:contact@azarex.net" class="text-primary">contact@azarex.net</a>
                        </div>
                    </div>
                </div><!--end col-->

                <div class="col-md-4 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="contact-detail text-center">
                        <div class="icon">
                            <img src="{{asset('images/icon/location.svg')}}" alt="">
                        </div>
                        <div class="content mt-3">
                            <h4 class="title font-weight-bold">موقعیت</h4>
                            <p class="text-muted">تهران - چهارراه ولیعصر - برج فناوری امیرکبیر - طبقه دوم</p>
                            <a href="https://goo.gl/maps/73xn4g7nbMcEQRtKA" class="video-play-icon h6 text-primary">لوکیشن گوگل مپ</a>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->

{{--        <div class="container mt-100 mt-60">--}}
{{--            <div class="row align-items-center">--}}
{{--                <div class="col-lg-5 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0 order-2 order-md-1">--}}
{{--                    <div class="pt-5 pb-5 p-4 bg-light shadow rounded">--}}
{{--                        <h4>در ارتباط باشید !</h4>--}}
{{--                        <div class="custom-form mt-4">--}}
{{--                            <div id="message"></div>--}}
{{--                            <form method="post" action="{{route('pages.contact')}}" name="contact-form" id="contact-form">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="form-group position-relative">--}}
{{--                                            <label>نام شما <span class="text-danger">*</span></label>--}}
{{--                                            <i class="mdi mdi-account ml-3 icons"></i>--}}
{{--                                            <input name="name" id="name" type="text" class="form-control pl-5" placeholder="نام شما :">--}}
{{--                                        </div>--}}
{{--                                    </div><!--end col-->--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="form-group position-relative">--}}
{{--                                            <label>ایمیل شما <span class="text-danger">*</span></label>--}}
{{--                                            <i class="mdi mdi-email ml-3 icons"></i>--}}
{{--                                            <input name="email" id="email" type="email" class="form-control pl-5" placeholder="ایمیل شما :">--}}
{{--                                        </div>--}}
{{--                                    </div><!--end col-->--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-group position-relative">--}}
{{--                                            <label>موضوع</label>--}}
{{--                                            <i class="mdi mdi-book ml-3 icons"></i>--}}
{{--                                            <input name="subject" id="subject" class="form-control pl-5" placeholder="موضوع شما :">--}}
{{--                                        </div>--}}
{{--                                    </div><!--end col-->--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-group position-relative">--}}
{{--                                            <label>نظرات</label>--}}
{{--                                            <i class="mdi mdi-comment-text-outline ml-3 icons"></i>--}}
{{--                                            <textarea name="comments" id="comments" rows="4" class="form-control pl-5" placeholder="پیام شما :"></textarea>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div><!--end row-->--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-sm-12 text-center">--}}
{{--                                        <input type="submit" id="submit" name="send" class="submitBnt btn btn-primary btn-block" value="ارسال پیام">--}}
{{--                                        <div id="simple-msg"></div>--}}
{{--                                    </div><!--end col-->--}}
{{--                                </div><!--end row-->--}}
{{--                            </form><!--end form-->--}}
{{--                        </div><!--end custom-form-->--}}
{{--                    </div>--}}
{{--                </div><!--end col-->--}}

{{--                <div class="col-lg-7 col-md-6 order-1 order-md-2">--}}
{{--                    <img src="{{asset('images/contact.png')}}" class="img-fluid" alt="">--}}
{{--                </div><!--end col-->--}}
{{--            </div><!--end row-->--}}
{{--        </div><!--end container-->--}}

        <div class="container-fluid mt-100 mt-60">
            <div class="row">
                <div class="col-12 p-0">
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d103699.27304061918!2d51.3504652191914!3d35.68679381866733!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8e01a9cd0203db%3A0x9e9a0a5f7f3ffa5a!2sFinnova%20Co-Working%20Space!5e0!3m2!1sen!2str!4v1613816764035!5m2!1sen!2str" style="border:0" allowfullscreen="" loading="lazy"></iframe>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section>
@endsection
