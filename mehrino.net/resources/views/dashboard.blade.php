@extends('partials.panel')
@section('page.title', 'پیشخوان')
{{--@section('plus')--}}
{{--    <a href="#" class="button border with-icon">افزودن آگهی <i class="sl sl-icon-plus"></i></a>--}}
{{--@endsection--}}
@section('wrapper')
    <div class="dashboard-content">

        <!-- Titlebar -->
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>خوش آمدید، {{ auth('web')->user()->name }}</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">صفحه اصلی</a></li>
                            <li>داشبورد</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Notice -->
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="notification success closeable margin-bottom-30">--}}
{{--                    <p>آگهی شما <strong>هتل پیروزی</strong> تایید شده است!</p>--}}
{{--                    <a class="close" href="#"></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- Content -->
{{--        <div class="row">--}}

{{--            <!-- Item -->--}}
{{--            <div class="col-lg-3 col-md-6">--}}
{{--                <div class="dashboard-stat color-1">--}}
{{--                    <div class="dashboard-stat-content"><h4>6</h4> <span>آگهی های فعال</span></div>--}}
{{--                    <div class="dashboard-stat-icon"><i class="im im-icon-Map2"></i></div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- Item -->--}}
{{--            <div class="col-lg-3 col-md-6">--}}
{{--                <div class="dashboard-stat color-2">--}}
{{--                    <div class="dashboard-stat-content"><h4>726</h4> <span>مجموع بازدیدها</span></div>--}}
{{--                    <div class="dashboard-stat-icon"><i class="im im-icon-Line-Chart"></i></div>--}}
{{--                </div>--}}
{{--            </div>--}}


{{--            <!-- Item -->--}}
{{--            <div class="col-lg-3 col-md-6">--}}
{{--                <div class="dashboard-stat color-3">--}}
{{--                    <div class="dashboard-stat-content"><h4>95</h4> <span>مجموع نظرات</span></div>--}}
{{--                    <div class="dashboard-stat-icon"><i class="im im-icon-Add-UserStar"></i></div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- Item -->--}}
{{--            <div class="col-lg-3 col-md-6">--}}
{{--                <div class="dashboard-stat color-4">--}}
{{--                    <div class="dashboard-stat-content"><h4>126</h4> <span>زمانبندی شده</span></div>--}}
{{--                    <div class="dashboard-stat-icon"><i class="im im-icon-Heart"></i></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}


{{--        <div class="row">--}}

{{--            <!-- Recent Activity -->--}}
{{--            <div class="col-lg-6 col-md-12">--}}
{{--                <div class="dashboard-list-box with-icons margin-top-20">--}}
{{--                    <h4>فعالیت های اخیر</h4>--}}
{{--                    <ul>--}}
{{--                        <li>--}}
{{--                            <i class="list-box-icon sl sl-icon-layers"></i> آگهی شما<strong><a href="#">هتل پیروزی</a></strong> تایید شده است!--}}
{{--                            <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <i class="list-box-icon sl sl-icon-star"></i> جعفر عباسی بررسی را ترک کرد <div class="numerical-rating" data-rating="5.0"></div> بر <strong><a href="#">خانه برگر</a></strong>--}}
{{--                            <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <i class="list-box-icon sl sl-icon-heart"></i> کسی شما را نشانه گذاری کرده است <strong><a href="#">خانه برگر</a></strong> آگهی!--}}
{{--                            <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <i class="list-box-icon sl sl-icon-star"></i> کتی براون بررسی را ترک کرد <div class="numerical-rating" data-rating="3.0"></div> بر <strong><a href="#">فرودگاه</a></strong>--}}
{{--                            <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <i class="list-box-icon sl sl-icon-heart"></i> کسی شما را نشانه گذاری کرده است <strong><a href="#">خانه برگر</a></strong> آگهی!--}}
{{--                            <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <i class="list-box-icon sl sl-icon-star"></i> طاهر نصیری بررسی را ترک کرد <div class="numerical-rating" data-rating="4.0"></div> بر <strong><a href="#">خانه برگر</a></strong>--}}
{{--                            <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <i class="list-box-icon sl sl-icon-star"></i> فرشید بررسی را ترک کرد <div class="numerical-rating" data-rating="2.5"></div> بر <strong><a href="#">رستوران تام</a></strong>--}}
{{--                            <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- Invoices -->--}}
{{--            <div class="col-lg-6 col-md-12">--}}
{{--                <div class="dashboard-list-box invoices with-icons margin-top-20">--}}
{{--                    <h4>فاکتورها</h4>--}}
{{--                    <ul>--}}

{{--                        <li><i class="list-box-icon sl sl-icon-doc"></i>--}}
{{--                            <strong>پلن حرفه ای</strong>--}}
{{--                            <ul>--}}
{{--                                <li class="unpaid">پرداخت نشده</li>--}}
{{--                                <li>سفارش: #00124</li>--}}
{{--                                <li>تاریخ: 20/07/2019</li>--}}
{{--                            </ul>--}}
{{--                            <div class="buttons-to-right">--}}
{{--                                <a href="dashboard-invoice.html" class="button gray">مشاهده صورتحساب</a>--}}
{{--                            </div>--}}
{{--                        </li>--}}

{{--                        <li><i class="list-box-icon sl sl-icon-doc"></i>--}}
{{--                            <strong>پلن گسترده</strong>--}}
{{--                            <ul>--}}
{{--                                <li class="paid">پرداخت شده</li>--}}
{{--                                <li>سفارش: #00108</li>--}}
{{--                                <li>تاریخ: 14/07/2019</li>--}}
{{--                            </ul>--}}
{{--                            <div class="buttons-to-right">--}}
{{--                                <a href="dashboard-invoice.html" class="button gray">مشاهده صورتحساب</a>--}}
{{--                            </div>--}}
{{--                        </li>--}}

{{--                        <li><i class="list-box-icon sl sl-icon-doc"></i>--}}
{{--                            <strong>پلن سفارشی</strong>--}}
{{--                            <ul>--}}
{{--                                <li class="paid">پرداخت شده</li>--}}
{{--                                <li>سفارش: #00097</li>--}}
{{--                                <li>تاریخ: 10/07/2019</li>--}}
{{--                            </ul>--}}
{{--                            <div class="buttons-to-right">--}}
{{--                                <a href="dashboard-invoice.html" class="button gray">مشاهده صورتحساب</a>--}}
{{--                            </div>--}}
{{--                        </li>--}}

{{--                        <li><i class="list-box-icon sl sl-icon-doc"></i>--}}
{{--                            <strong>پلن اصلی</strong>--}}
{{--                            <ul>--}}
{{--                                <li class="paid">پرداخت شده</li>--}}
{{--                                <li>سفارش: #00091</li>--}}
{{--                                <li>تاریخ: 30/06/2019</li>--}}
{{--                            </ul>--}}
{{--                            <div class="buttons-to-right">--}}
{{--                                <a href="dashboard-invoice.html" class="button gray">مشاهده صورتحساب</a>--}}
{{--                            </div>--}}
{{--                        </li>--}}

{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}


{{--            <!-- Copyrights -->--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="copyrights">© 1398 لیستئو. تمامی حقوق محفوظ است.</div>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>
@endsection
