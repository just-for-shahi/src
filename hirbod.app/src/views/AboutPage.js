import React from "react";
import MasterPage from "../Layouts/Master/Master";

export default function AboutPage() {
    return (
        <MasterPage>
            <div className="main">
                {/*page header section start*/}
                <section className="page-header-section ptb-100 bg-image" image-overlay={8}>
                    <div className="background-image-wraper" style={{ background: 'url("assets/img/slider-bg-1.jpg")', opacity: 1 }} />
                    <div className="container">
                        <div className="row align-items-center">
                            <div className="col-md-9 col-lg-7">
                                <div className="page-header-content text-white pt-4">
                                    <h1 className="text-white mb-0">درباره ما</h1>
                                    <p className="lead">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {/*page header section end*/}
                {/*breadcrumb section start*/}
                <div className="breadcrumb-bar gray-light-bg border-bottom">
                    <div className="container">
                        <div className="row">
                            <div className="col-12">
                                <div className="custom-breadcrumb">
                                    <ol className="breadcrumb pl-0 mb-0 bg-transparent">
                                        <li className="breadcrumb-item"><a href="#">خانه</a></li>
                                        <li className="breadcrumb-item"><a href="#">صفحات</a></li>
                                        <li className="breadcrumb-item active">درباره ما</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {/*breadcrumb section end*/}
                {/*about us section start*/}
                {/*about us section start*/}
                <div className="overflow-hidden">
                    {/*about us section start*/}
                    <section id="about" className="position-relative overflow-hidden feature-section ptb-100  ">
                        <div className="container">
                            <div className="row align-items-center justify-content-between">
                                <div className="col-md-12 col-lg-6">
                                    <div className="feature-contents section-heading">
                                        <h2>مفیدترین منبع ایجاد شده برای طراحان</h2>
                                        <p>از نظر عینی ارزش حرفه ای را با آمادگی متنوع وب ارائه دهید. مشارکتی خدمات بی سیم مشتری را بدون تغییر کاتالیزورهای هدفمند برای تغییر انتقال دهید. از نظر همکاری</p>
                                        <ul className="check-list-wrap list-two-col py-3">
                                            <li>بررسی کیفیت داده ها</li>
                                            <li>محیط کار ایمن</li>
                                            <li>پشتیبانی 24x7</li>
                                            <li>به روزرسانی ها</li>
                                            <li>تیم مدیریت</li>
                                            <li>پشتیبانی فنی</li>
                                            <li>ادغام آماده است</li>
                                            <li>متن ساختگی</li>
                                            <li>سازگاری محور فرایند</li>
                                            <li>مدیریت نیروی کار</li>
                                        </ul>
                                        <div className="action-btns mt-4">
                                            <a href="#" className="btn btn-brand-02 mr-3">اکنون شروع کنید </a>
                                            <a href="#" className="btn btn-outline-brand-02">بیشتر بدانید</a>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-md-6 col-lg-6">
                                    <div className>
                                        <img src="assets/img/Capture.PNG" className="img-fluid" alt="درباره ما" />
                                        <div className="item-icon video-promo-content">
                                            <a href="https://www.youtube.com/watch?v=9No-FiEInLA" className="popup-youtube video-play-icon text-center m-auto"><span className="ti-control-play" /> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    {/*about us section end*/}
                </div>
                {/*about us section end*/}
                {/*about us section end*/}
                {/*video section with counter start*/}
                <section className="position-relative overflow-hidden ptb-100">
                    <div className="background-image-wraper mask-65" />
                    <div className="container">
                        <div className="row justify-content-center">
                            <div className="col-md-9 col-lg-8">
                                <div className="section-heading text-center text-white">
                                    <h2 className="text-white">بیشترین استفاده از بستر برنامه را دارد</h2>
                                    <p>کار را با آن شروع کنید که می تواند همه چیز را برای ایجاد آگاهی ، رانندگی ترافیک ، اتصال فراهم کند. ارزش دانه ای را با محتوای متمرکز بر مشتری تغییر دهید. بازتعریف بازار.</p>
                                </div>
                                <div className="video-promo-content my-5">
                                    <a href="https://www.youtube.com/watch?v=9No-FiEInLA" className="popup-youtube video-play-icon text-center m-auto"><span className="ti-control-play" /> </a>
                                </div>
                            </div>
                            {/*end col*/}
                        </div>
                        {/*end row*/}
                        <div className="row">
                            <div className="col-sm-6 col-md-6 col-lg-3">
                                <div className="bg-white p-5 rounded shadow count-data text-center mt-4">
                                    <span className="fas fa-users  color-primary icon-size-lg mb-2" />
                                    <h3 className="count-number mb-1 color-secondary font-weight-bolder">21023</h3>
                                    <h6 className="mb-0">مشتریان</h6>
                                </div>
                            </div>
                            <div className="col-sm-6 col-md-6 col-lg-3">
                                <div className="bg-white p-5 rounded shadow count-data text-center mt-4">
                                    <span className="fas fa-cloud-download-alt  color-primary icon-size-lg mb-2" />
                                    <h3 className="count-number mb-1 color-secondary font-weight-bolder">44023</h3>
                                    <h6 className="mb-0">بارگیری ها</h6>
                                </div>
                            </div>
                            <div className="col-sm-6 col-md-6 col-lg-3">
                                <div className="bg-white p-5 rounded shadow count-data text-center mt-4">
                                    <span className="fas fa-smile  color-primary icon-size-lg mb-2" />
                                    <h3 className="count-number mb-1 color-secondary font-weight-bolder">35023</h3>
                                    <h6 className="mb-0">رضایت مشتری</h6>
                                </div>
                            </div>
                            <div className="col-sm-6 col-md-6 col-lg-3">
                                <div className="bg-white p-5 rounded shadow count-data text-center mt-4">
                                    <span className="fas fa-mug-hot  color-primary icon-size-lg mb-2" />
                                    <h3 className="count-number mb-1 color-secondary font-weight-bolder">2323</h3>
                                    <h6 className="mb-0">فنجان قهوه</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {/*video section with counter end*/}
                {/*video section with counter start*/}
                <section id="process" className="work-process-section position-relative pb-100 ">
                    <div className="container">
                        <div className="row justify-content-center">
                            <div className="col-md-9 col-lg-8">
                                <div className="section-heading text-center mb-5">
                                    <h2>برنامه ریزی کار ما</h2>
                                    <p>
                                        میزبانی حرفه ای با قیمت مناسب. مجزا صلاحیت های اصلی محور را از طریق صلاحیت های اصلی مشتری محور بازآفرینی کنید.
            </p>
                                </div>
                            </div>
                        </div>
                        <div className="row align-items-center justify-content-md-center justify-content-sm-center">
                            <div className="col-md-12 col-lg-6">
                                <div className="work-process-wrap">
                                    <div className="process-single-item">
                                        <div className="process-icon-item left-shape">
                                            <div className="d-flex align-items-center">
                                                <div className="process-icon mr-4">
                                                    <i className="fas fa-project-diagram color-primary" />
                                                </div>
                                                <div className="process-content text-left">
                                                    <h5>ایده برنامه ریزی</h5>
                                                    <p>کاملاً معمار متا-خدمات پایدار را برای صلاحیت های هسته پردازش محور معمار می کند. با اشتیاق مجدداً برون سپاری از بهترین نژادها را مهندسی کنید.</p>
                                                </div>
                                            </div>
                                            <svg x="0px" y="0px" width="312px" height="130px">
                                                <path className="dashed1" fill="none" stroke="rgb(95, 93, 93)" strokeWidth={1} strokeDasharray={1300} strokeDashoffset={0} d="M3.121,2.028 C3.121,2.028 1.003,124.928 99.352,81.226 C99.352,81.226 272.319,21.200 310.000,127.338" />
                                                <path className="dashed2" fill="none" stroke="#ffffff" strokeWidth={2} strokeDasharray={6} strokeDashoffset={1300} d="M3.121,2.028 C3.121,2.028 1.003,124.928 99.352,81.226 C99.352,81.226 272.319,21.200 310.000,127.338 " />
                                            </svg>
                                        </div>
                                    </div>
                                    <div className="process-single-item">
                                        <div className="process-icon-item right-shape">
                                            <div className="d-flex align-items-center">
                                                <div className="process-icon ml-4">
                                                    <i className="fas fa-puzzle-piece color-primary" />
                                                </div>
                                                <div className="process-content text-right">
                                                    <h5>محصول نهایی توسعه یافته است</h5>
                                                    <p>آمادگی یکپارچه وب را پس از کاتالیزورهای مبتنی بر چندرسانه ای برای تغییر مهار می کنید. سیستم های جلویی کاملاً نام تجاری قبل از بینایی.</p>
                                                </div>
                                            </div>
                                            <svg x="0px" y="0px" width="312px" height="130px">
                                                <path className="dashed1" fill="none" stroke="rgb(95, 93, 93)" strokeWidth={1} strokeDasharray={1300} strokeDashoffset={0} d="M311.000,0.997 C311.000,0.997 313.123,123.592 214.535,79.996 C214.535,79.996 41.149,20.122 3.377,125.996" />
                                                <path className="dashed2" fill="none" stroke="#ffffff" strokeWidth={2} strokeDasharray={6} strokeDashoffset={1300} d="M311.000,0.997 C311.000,0.997 313.123,123.592 214.535,79.996 C214.535,79.996 41.149,20.122 3.377,125.996" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div className="process-single-item">
                                        <div className="process-icon-item left-shape mb-0">
                                            <div className="d-flex align-items-center">
                                                <div className="process-icon mr-4">
                                                    <i className="fas fa-truck color-primary" />
                                                </div>
                                                <div className="process-content text-left">
                                                    <h5>تحویل به مشتری</h5>
                                                    <p>تجارت یکپارچه هم افزایی تجارت الکترونیکی به صورت یکپارچه ادبی می کند. از نظر حرفه ای محصولات تولید شده بینایی را به صورت مترقی افزایش دهید.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-6 col-lg-6">
                                <div className="img-wrap">
                                    <img src="assets/img/app-mobile-image-3.png" alt="امکانات" className="img-fluid" />
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {/*video section with counter end*/}
                {/*our team section start*/}
                <section className="team-two-section ptb-100 gray-light-bg">
                    <div className="container">
                        <div className="row justify-content-center">
                            <div className="col-md-9 col-lg-8">
                                <div className="section-heading text-center">
                                    <h2>اعضای تیم ما</h2>
                                    <p>به طور موثق پارادایمهای شهودی را در مقابل مشارکتهای هدف محور مشبک کنید. پس از کاتالیزورهای متمرکز ، به طور مداوم منبع باز را در خارج از جعبه گسترش دهید.</p>
                                </div>
                            </div>
                        </div>
                        <div className="row">
                            <div className="col-md-6 col-lg-3">
                                <div className="single-team-wrap bg-white text-center border rounded p-4 mt-4">
                                    <img src="assets/img/team/team-member-1.png" alt="تصویر تیم" width={120} className="img-fluid m-auto pb-4" />
                                    <div className="team-content">
                                        <h5 className="mb-0">ریچارد فورد</h5>
                                        <span>تحلیلگر</span>
                                        <p className="mt-3">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                                        <ul className="list-inline social-list-default social-color icon-hover-top-bottom">
                                            <li className="list-inline-item">
                                                <a className="facebook" href="#" target="_blank"><i className="fab fa-facebook-f" /></a>
                                            </li>
                                            <li className="list-inline-item">
                                                <a className="twitter" href="#" target="_blank"><i className="fab fa-twitter" /></a>
                                            </li>
                                            <li className="list-inline-item">
                                                <a className="dribbble" href="#" target="_blank"><i className="fab fa-dribbble" /></a>
                                            </li>
                                            <li className="list-inline-item">
                                                <a className="linkedin" href="#" target="_blank"><i className="fab fa-linkedin-in" /></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-6 col-lg-3">
                                <div className="single-team-wrap bg-white text-center border rounded p-4 mt-4">
                                    <img src="assets/img/team/team-member-2.png" alt="تصویر تیم" width={120} className="img-fluid m-auto pb-4" />
                                    <div className="team-content">
                                        <h5 className="mb-0">نام کاربر</h5>
                                        <span>طراح سرب</span>
                                        <p className="mt-3">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                                        <ul className="list-inline social-list-default social-color icon-hover-top-bottom">
                                            <li className="list-inline-item">
                                                <a className="facebook" href="#" target="_blank"><i className="fab fa-facebook-f" /></a>
                                            </li>
                                            <li className="list-inline-item">
                                                <a className="twitter" href="#" target="_blank"><i className="fab fa-twitter" /></a>
                                            </li>
                                            <li className="list-inline-item">
                                                <a className="dribbble" href="#" target="_blank"><i className="fab fa-dribbble" /></a>
                                            </li>
                                            <li className="list-inline-item">
                                                <a className="linkedin" href="#" target="_blank"><i className="fab fa-linkedin-in" /></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-6 col-lg-3">
                                <div className="single-team-wrap bg-white text-center border rounded p-4 mt-4">
                                    <img src="assets/img/team/team-member-3.png" alt="تصویر تیم" width={120} className="img-fluid m-auto pb-4" />
                                    <div className="team-content">
                                        <h5 className="mb-0">جرالد نیکولز</h5>
                                        <span>مدیر عامل</span>
                                        <p className="mt-3">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                                        <ul className="list-inline social-list-default social-color icon-hover-top-bottom">
                                            <li className="list-inline-item">
                                                <a className="facebook" href="#" target="_blank"><i className="fab fa-facebook-f" /></a>
                                            </li>
                                            <li className="list-inline-item">
                                                <a className="twitter" href="#" target="_blank"><i className="fab fa-twitter" /></a>
                                            </li>
                                            <li className="list-inline-item">
                                                <a className="dribbble" href="#" target="_blank"><i className="fab fa-dribbble" /></a>
                                            </li>
                                            <li className="list-inline-item">
                                                <a className="linkedin" href="#" target="_blank"><i className="fab fa-linkedin-in" /></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-6 col-lg-3">
                                <div className="single-team-wrap bg-white text-center border rounded p-4 mt-4">
                                    <img src="assets/img/team/team-member-4.png" alt="تصویر تیم" width={120} className="img-fluid m-auto pb-4" />
                                    <div className="team-content">
                                        <h5 className="mb-0">جرالد نیکولز</h5>
                                        <span>مدیر تیم</span>
                                        <p className="mt-3">قبل از پردازش موازی ، همزمان فناوری های پیشرفته فناوری های جعبه را تحقق بخشید</p>
                                        <ul className="list-inline social-list-default social-color icon-hover-top-bottom">
                                            <li className="list-inline-item">
                                                <a className="facebook" href="#" target="_blank"><i className="fab fa-facebook-f" /></a>
                                            </li>
                                            <li className="list-inline-item">
                                                <a className="twitter" href="#" target="_blank"><i className="fab fa-twitter" /></a>
                                            </li>
                                            <li className="list-inline-item">
                                                <a className="dribbble" href="#" target="_blank"><i className="fab fa-dribbble" /></a>
                                            </li>
                                            <li className="list-inline-item">
                                                <a className="linkedin" href="#" target="_blank"><i className="fab fa-linkedin-in" /></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {/*our team section end*/}
                {/*our team section start*/}
                <section className="client-section  ptb-100">
                    <div className="container">
                        <div className="row justify-content-center">
                            <div className="col-md-8">
                                <div className="section-heading text-center mb-5">
                                    <h2>مشتریان ارزشمند ما</h2>
                                    <p>
                                        منابع شفاف داخلی و یا منابع شفاف در حالی که منابع در حال مکیدن تجارت الکترونیکی هستند. به راحتی نوآورانه قانع کننده داخلی.
            </p>
                                </div>
                            </div>
                        </div>
                        <div className="row align-items-center">
                            <div className="col-md-12">
                                <div className="owl-carousel owl-theme clients-carousel dot-indicator">
                                    <div className="item single-customer">
                                        <img src="assets/img/customers/clients-logo-01.png" alt="آرم مشتری" className="customer-logo" />
                                    </div>
                                    <div className="item single-customer">
                                        <img src="assets/img/customers/clients-logo-02.png" alt="آرم مشتری" className="customer-logo" />
                                    </div>
                                    <div className="item single-customer">
                                        <img src="assets/img/customers/clients-logo-03.png" alt="آرم مشتری" className="customer-logo" />
                                    </div>
                                    <div className="item single-customer">
                                        <img src="assets/img/customers/clients-logo-04.png" alt="آرم مشتری" className="customer-logo" />
                                    </div>
                                    <div className="item single-customer">
                                        <img src="assets/img/customers/clients-logo-05.png" alt="آرم مشتری" className="customer-logo" />
                                    </div>
                                    <div className="item single-customer">
                                        <img src="assets/img/customers/clients-logo-06.png" alt="آرم مشتری" className="customer-logo" />
                                    </div>
                                    <div className="item single-customer">
                                        <img src="assets/img/customers/clients-logo-07.png" alt="آرم مشتری" className="customer-logo" />
                                    </div>
                                    <div className="item single-customer">
                                        <img src="assets/img/customers/clients-logo-08.png" alt="آرم مشتری" className="customer-logo" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {/*our team section end*/}
            </div>


        </MasterPage>
    )
};