@extends('partials.front')
@section('page.title', 'صفحه‌نخست')
@section('wrapper')
<main class="main">
        <!-- promo start-->
        <section class="promo">
            <div class="promo-slider">
                <div class="promo-slider__item promo-slider__item--style-1">
                    <picture>
                        <source srcset="img/promo_1.jpg" media="(min-width: 835px)"/>
                        <source srcset="img/834promo_1.jpg" media="(min-width: 376px)"/>
                        <img class="img--bg" src="img/375promo_1.jpg" alt="img"/>
                    </picture>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="align-container">
                                    <div class="align-container__item">
                                        <div class="promo-slider__wrapper-1">
                                            <h2 class="promo-slider__title"><span>ما به همه ایران کمک می کنیم</span>
                                                <span>دورترین نقاط به ما نزدیک است</span></h2>
                                        </div>
                                        <div class="promo-slider__wrapper-2">
                                            <p class="promo-slider__subtitle">شناسایی و اولویت بندی نیاز های مناطق
                                                محروم </p>
                                        </div>
                                        <div class="promo-slider__wrapper-3"><a
                                                class="button promo-slider__button button--primary" href="#">اطلاعات
                                                بیشتر</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="promo-slider__item promo-slider__item--style-2">
                    <picture>
                        <source srcset="img/promo_2.jpg" media="(min-width: 835px)"/>
                        <source srcset="img/834promo_2.jpg" media="(min-width: 376px)"/>
                        <img class="img--bg" src="img/375promo_2.jpg" alt="img"/>
                    </picture>
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-7">
                                <div class="align-container">
                                    <div class="align-container__item">
                                        <div class="promo-slider__wrapper-1">
                                            <h2 class="promo-slider__title"><span>کمکی بی پایان</span><br/><span>برای ایرانی سربلند</span>
                                            </h2>
                                        </div>
                                        <div class="promo-slider__wrapper-2">
                                            <p class="promo-slider__subtitle">مهرینو با راهکار جدید پا به میدان گذاشته
                                                تا سرچشمه ای باشد بی پایان برای کمک به نیازمندان</p>
                                        </div>
                                        <div class="promo-slider__wrapper-3"><a
                                                class="button promo-slider__button button--primary" href="#">اطلاعات
                                                بیشتر</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="promo-slider__item promo-slider__item--style-3">
                    <picture>
                        <source srcset="img/promo_3.jpg" media="(min-width: 835px)"/>
                        <source srcset="img/834promo_3.jpg" media="(min-width: 376px)"/>
                        <img class="img--bg" src="img/375promo_3.jpg" alt="img"/>
                    </picture>
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 offset-xl-2">
                                <div class="align-container">
                                    <div class="align-container__item">
                                        <div class="promo-slider__wrapper-1">
                                            <h2 class="promo-slider__title"><span>مهرینو، مهری نو</span><br/><span>به شیوه ای جدید</span>
                                            </h2>
                                        </div>
                                        <div class="promo-slider__wrapper-2">
                                            <p class="promo-slider__subtitle">مناطق محروم کشور به چشمه ای بی پایان برای
                                                کمک نقدی نیازمندند</p>
                                        </div>
                                        <div class="promo-slider__wrapper-3"><a
                                                class="button promo-slider__button button--primary" href="#">اطلاعات
                                                بیشتر</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- promo socials start-->
            <ul class="promo-socials">
                <li class="promo-socials__item"><a class="promo-socials__link" href="https://www.instagram.com/Mehrino.Official/"><i class="fa fa-instagram"
                                                                                           aria-hidden="true"></i></a>
                </li>
{{--                <li class="promo-socials__item"><a class="promo-socials__link" href="#"><i class="fa fa-google-plus"--}}
{{--                                                                                           aria-hidden="true"></i></a>--}}
{{--                </li>--}}
{{--                <li class="promo-socials__item"><a class="promo-socials__link" href="#"><i class="fa fa-twitter"--}}
{{--                                                                                           aria-hidden="true"></i></a>--}}
{{--                </li>--}}
{{--                <li class="promo-socials__item"><a class="promo-socials__link" href="#"><i class="fa fa-facebook"--}}
{{--                                                                                           aria-hidden="true"></i></a>--}}
{{--                </li>--}}
            </ul>
            <!-- promo socials end-->
            <!-- promo pannel start-->
            <div class="promo-pannel"><a class="anchor promo-pannel__anchor" href="#about">
                    <span>اطلاعات بیشتر</span></a>
                <div class="promo-pannel__video"><img class="img--bg" src="img/video_block.jpg" alt="image"/><a
                        class="video-trigger"
                        href="https://www.youtube.com/watch?v=_sI_Ps7JSEk"><span>بخشی از کمک ها</span><i
                            class="fa fa-play" aria-hidden="true"></i></a></div>
                <div class="promo-pannel__phones">
                    <p class="promo-pannel__title">تلفن تماس</p>
                    <a class="promo-pannel__link" href="tel:02128422655">
                        02128422655
                    </a>
                </div>
                <div class="promo-pannel__email">
                    <p class="promo-pannel__title">ایمیل</p><a class="promo-pannel__link"
                                                               href="mailto:support@mehrino.com">support@mehrino.com</a>
                </div>
            </div>
            <!-- promo pannel end-->
            <!-- slider nav start-->
            <div class="slider__nav slider__nav--promo">
                <div class="promo-slider__count"></div>
                <div class="slider__arrows">
                    <div class="slider__prev"><i class="fa fa-chevron-left" aria-hidden="true"></i>
                    </div>
                    <div class="slider__next"><i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <!-- slider nav end-->
        </section>
        <!-- promo end-->
        <!-- about us start-->
        <section class="section about-us" id="about">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="heading heading--primary"><span class="heading__pre-title">درباره مهرینو</span>
                            <h2 class="heading__title"><span>مهری بی پایان</span> <span>به همه ایران</span></h2>
                        </div>
                        <p><strong>پس از حادثه غم انگیز زلزله کرمانشاه و بررسی شرایط ساخت ساز و بازسازی به این نتیجه
                                رسیدیم که برای ساعت ساز با سرعت بیشتر نیاز به منابع بسیار زیاد وجود دارد پس تصمیم گرفتیم
                                راهکاری نو را پایه گذاری کنیم"</strong></p>
                        <p>این روش جمع آوری کمک های نقدی به صورت رشد سرمایه انجام میپذیرید، ما با کمک کارشناسان برجسته
                            اقتصادی و فرمولهای پیچیده ریاضی سامانه ای را طرح ریزی کردیم تا به کمک هموطنان خیر کمک هزینه
                            های نقدی در صندوق های پرسود سرمایه گذاری رشد داده شده و کتر از 10 روز وارد چرخه کمک رسانی
                            شود</p>
                        <p>ماه ها برای این طرح زمان صرف شده تا بهترین و سریع ترین </p><a class="button button--primary"
                                                                                         href="about.html">بیشتر
                            بدانید</a>
                    </div>
                    <div class="col-lg-6 col-xl-5 offset-xl-1">
                        <div class="info-box"><img class="img--layout" src="img/about_layout.png" alt="img"/><img
                                class="img--bg" src="img/about-us.jpg" alt="img"/>
                            <h4 class="info-box__title">با همراهی شما بهترینیم</h4>
                            <p>هیچ روستایی در ایران نباید بی آب بماند</p><a class="info-box__link"
                                                                            href="volunteer.html">با ما همراه باشید</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about us end-->
        <!-- icons section start-->
        <section class="section icons-section no-padding-top">
            <div class="container">
                <div class="row margin-bottom">
                    <div class="col-12">
                        <div class="heading heading--center"><span class="heading__pre-title">خدمات مهرینو</span>
                            <h2 class="heading__title"><span>خدمات مهرینو</span> <span>برای همه مردم ایران</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 col-lg-3">
                        <div class="icon-item">
                            <div class="icon-item__img"><img class="img--layout" src="img/icon_1-1.png" alt="img"/>
                                <svg class="icon icon-item__icon icon--red">
                                    <use xlink:href="#donation"></use>
                                </svg>
                            </div>
                            <div class="icon-item__text">
                                <p>کمک های پزشکی</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="icon-item">
                            <div class="icon-item__img"><img class="img--layout" src="img/icon_2-2.png" alt="img"/>
                                <svg class="icon icon-item__icon icon--orange">
                                    <use xlink:href="#school"></use>
                                </svg>
                            </div>
                            <div class="icon-item__text">
                                <p>ساخت و بازسازی </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="icon-item">
                            <div class="icon-item__img"><img class="img--layout" src="img/icon_3-3.png" alt="img"/>
                                <svg class="icon icon-item__icon icon--green">
                                    <use xlink:href="#blood"></use>
                                </svg>
                            </div>
                            <div class="icon-item__text">
                                <p>آبرسانی به روستا ها</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="icon-item">
                            <div class="icon-item__img"><img class="img--layout" src="img/icon_4-4.png" alt="img"/>
                                <svg class="icon icon-item__icon icon--blue">
                                    <use xlink:href="#charity"></use>
                                </svg>
                            </div>
                            <div class="icon-item__text">
                                <p>مراقبت و نگهداری</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- icons section end-->
        <!-- causes start-->
{{--        <section class="section causes"><img class="causes__bg" src="img/causes_img.png" alt="img"/>--}}
{{--            <div class="container">--}}
{{--                <div class="row align-items-end">--}}
{{--                    <div class="col-xl-5">--}}
{{--                        <div class="heading heading--primary"><span--}}
{{--                                class="heading__pre-title">ما چه انجام می دهیم</span>--}}
{{--                            <h2 class="heading__title"><span>کمک های</span> <span>مهرینو</span></h2>--}}
{{--                            <p>طی دو سال گذشته مهر های بیشماری از هموطنان شامل حال ما بوده و این سرچشمه جوشان همیشه پر--}}
{{--                                آب بوده همواره سعی بر آن داریم تا این راه ادامه دااشته باشد</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-6 offset-xl-1 d-none d-xl-block">--}}
{{--                        <div class="row offset-margin">--}}
{{--                            <div class="col-6">--}}
{{--                                <div class="counter-item counter-item--style-3">--}}
{{--                                    <div class="counter-item__top">--}}
{{--                                        <h6 class="counter-item__title">افراد تحت پوشش مهرینو در سال 1398</h6>--}}
{{--                                    </div>--}}
{{--                                    <div class="counter-item__lower"><span--}}
{{--                                            class="js-counter">3684</span><span>نفر</span></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-6">--}}
{{--                                <div class="counter-item counter-item--style-3">--}}
{{--                                    <div class="counter-item__top">--}}
{{--                                        <h6 class="counter-item__title">هزینه های صرف آبادانی</h6>--}}
{{--                                    </div>--}}
{{--                                    <div class="counter-item__lower"><span--}}
{{--                                            class="js-counter">8</span><span>میلیارد</span></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row align-items-end margin-bottom">--}}
{{--                    <div class="col-sm-6"><a class="button button--primary" href="causes.html">کمک ها بیشتر</a></div>--}}
{{--                    <div class="col-sm-6 d-flex justify-content-sm-end">--}}
{{--                        <!-- slider nav start-->--}}
{{--                        <div class="slider__nav causes-slider__nav">--}}
{{--                            <div class="slider__arrows">--}}
{{--                                <div class="slider__prev"><i class="fa fa-chevron-left" aria-hidden="true"></i>--}}
{{--                                </div>--}}
{{--                                <div class="slider__next"><i class="fa fa-chevron-right" aria-hidden="true"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- slider nav end-->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="causes-holder offset-margin">--}}
{{--                <div class="causes-holder__wrapper">--}}
{{--                    <div class="causes-slider offset-margin">--}}
{{--                        <div class="causes-slider__item">--}}
{{--                            <div class="causes-item causes-item--primary">--}}
{{--                                <div class="causes-item__body">--}}
{{--                                    <div class="causes-item__top">--}}
{{--                                        <h6 class="causes-item__title"><a href="cause-details.html">آبرسانی روستای--}}
{{--                                                گرمانده</a></h6>--}}
{{--                                        <p>روستای گرمانده از توابع شهرستان بیرجند در استان خراسان جنوبی دچار بحران کمبود--}}
{{--                                            آب آشامیدنی شده</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="causes-item__img">--}}
{{--                                        <div class="causes-item__badge" style="background-color: #49C2DF">آبرسانی</div>--}}
{{--                                        <img class="img--bg" src="img/causes_1.jpg" alt="img"/>--}}
{{--                                    </div>--}}
{{--                                    <div class="causes-item__lower">--}}
{{--                                        <div class="progress-bar">--}}
{{--                                            <div class="progress-bar__inner" style="width: 78%;">--}}
{{--                                                <div class="progress-bar__value">78%</div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="causes-item__details-holder">--}}
{{--                                            <div class="causes-item__details-item"><span>هدف: </span><span>300.000.000 تومان</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="causes-item__details-item text-right">--}}
{{--                                                <span>مهرینو: </span><span>234.000.000 تومان</span></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <a class="button causes-item__button button--primary" href="#">+ افزایش مهرینو</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="causes-slider__item">--}}
{{--                            <div class="causes-item causes-item--primary">--}}
{{--                                <div class="causes-item__body">--}}
{{--                                    <div class="causes-item__top">--}}
{{--                                        <h6 class="causes-item__title"><a href="cause-details.html">پاکسازی بیماری پوستی--}}
{{--                                                روستای ذکری </a></h6>--}}
{{--                                        <p>با حضور پزشک داوطلب ۶۰ نفر از بیماران پوستی روستاهای ذکری تحت درمان قرار--}}
{{--                                            گرفتند</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="causes-item__img">--}}
{{--                                        <div class="causes-item__badge" style="background-color: #F36F8F">خدمات پزشکی--}}
{{--                                        </div>--}}
{{--                                        <img class="img--bg" src="img/causes_2.jpg" alt="img"/>--}}
{{--                                    </div>--}}
{{--                                    <div class="causes-item__lower">--}}
{{--                                        <div class="progress-bar">--}}
{{--                                            <div class="progress-bar__inner" style="width: 23%;">--}}
{{--                                                <div class="progress-bar__value">23%</div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="causes-item__details-holder">--}}
{{--                                            <div class="causes-item__details-item"><span>هدف: </span><span>60.000.000 تومان</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="causes-item__details-item text-right">--}}
{{--                                                <span>مهرینو: </span><span>13.800.000 تومان</span></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <a class="button causes-item__button button--primary" href="#">+ افزایش مهرینو</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="causes-slider__item">--}}
{{--                            <div class="causes-item causes-item--primary">--}}
{{--                                <div class="causes-item__body">--}}
{{--                                    <div class="causes-item__top">--}}
{{--                                        <h6 class="causes-item__title"><a href="cause-details.html">ساخت مدرسه--}}
{{--                                                آپادانا</a></h6>--}}
{{--                                        <p>ساخت مدرسه 6 کلاسه در روستای شیان از توابع شهرستان نیره استان چهارمحال و--}}
{{--                                            بختیاری</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="causes-item__img">--}}
{{--                                        <div class="causes-item__badge" style="background-color: #2EC774">ساخت و باز--}}
{{--                                            سازی--}}
{{--                                        </div>--}}
{{--                                        <img class="img--bg" src="img/causes_3.jpg" alt="img"/>--}}
{{--                                    </div>--}}
{{--                                    <div class="causes-item__lower">--}}
{{--                                        <div class="progress-bar">--}}
{{--                                            <div class="progress-bar__inner" style="width: 51%;">--}}
{{--                                                <div class="progress-bar__value">51%</div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="causes-item__details-holder">--}}
{{--                                            <div class="causes-item__details-item"><span>هدف: </span><span>800.000.000 تومان</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="causes-item__details-item text-right">--}}
{{--                                                <span>مهرینو: </span><span>450.000.000 تومان</span></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <a class="button causes-item__button button--primary" href="#">+ افزایش مهرینو</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="causes-slider__item">--}}
{{--                            <div class="causes-item causes-item--primary">--}}
{{--                                <div class="causes-item__body">--}}
{{--                                    <div class="causes-item__top">--}}
{{--                                        <h6 class="causes-item__title"><a href="cause-details.html">نانوایی در شهرستان--}}
{{--                                                دران آباد</a></h6>--}}
{{--                                        <p>ساخت نانوایی مکانیزه در روستای محروم دران آباد از توابع شهرستان بیرجند استان--}}
{{--                                            خراسان جنوبی</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="causes-item__img">--}}
{{--                                        <div class="causes-item__badge" style="background-color: #F8AC3A">تغذیه و--}}
{{--                                            سلامت--}}
{{--                                        </div>--}}
{{--                                        <img class="img--bg" src="img/causes_4.jpg" alt="img"/>--}}
{{--                                    </div>--}}
{{--                                    <div class="causes-item__lower">--}}
{{--                                        <div class="progress-bar">--}}
{{--                                            <div class="progress-bar__inner" style="width: 50%;">--}}
{{--                                                <div class="progress-bar__value">50%</div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="causes-item__details-holder">--}}
{{--                                            <div class="causes-item__details-item"><span>هدف: </span><span>250.000.000 تومان</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="causes-item__details-item text-right">--}}
{{--                                                <span>مهرینو: </span><span>125.000.000 تومان</span></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <a class="button causes-item__button button--primary" href="#">+ افزایش مهرینو</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
        <!-- causes end-->
        <!-- projects start-->
        <section class="section projects no-padding-top no-padding-bottom">
            <div class="container">
                <div class="row align-items-end margin-bottom">
                    <div class="col-lg-9">
                        <div class="heading heading--primary"><span class="heading__pre-title">مهرینو چه کرده است</span>
                            <h2 class="heading__title"><span>پروژه های</span> <span>مهرینو</span></h2>
                            <p class="no-margin-bottom">تا به امروز مهرینو بیش از 60 پروژه را به پایان رسانیده و همچنان
                                حمایت ها ادامه دارد </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row no-gutters projects-masonry">
                <div
                    class="col-lg-6 col-xl-4 projects-masonry__item projects-masonry__item--height-1 projects-masonry__item--vertical">
                    <div class="projects-masonry__img"><img class="img--bg" src="img/projects_1.jpg" alt="img"/></div>
                    <div class="projects-masonry__text" style="background-color: #2EC774;">
                        <div class="projects-masonry__inner"><span class="projects-masonry__badge"
                                                                   style="background: #49C2DF;">آب رسانی</span>
                            <h3 class="projects-masonry__title"><a href="cause-details.html">آبرسانی بیش از 13 روستای
                                    محروم</a></h3>
                            <p>یکی از اصلی ترین پروژه های مهرینو آبرسانی به مناطق خشک و محروم بوده است </p>
                            <div class="projects-masonry__details-holder">
                                <div class="projects-masonry__details-item"><span>مهرینو: </span><span>3.000.000.000 تومان</span>
                                </div>
                                <div class="projects-masonry__details-item">
                                    <span>تاریخ: </span><span>اردیبهشت 1399</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="col-lg-6 col-xl-8 projects-masonry__item projects-masonry__item--height-2 projects-masonry__item--horizontal">
                    <div class="projects-masonry__img"><img class="img--bg" src="img/projects_2.jpg" alt="img"/></div>
                    <div class="projects-masonry__text" style="background-color: #9BC35E;">
                        <div class="projects-masonry__inner"><span class="projects-masonry__badge"
                                                                   style="background: #F36F8F;">خدمات پزشکی</span>
                            <h3 class="projects-masonry__title"><a href="cause-details.html">خدمات سلامت و آموزش پزشکی و
                                    بهداشت</a></h3>
                            <p>در سال گذشته به بین از 16 منطقه خدمات پزشکی و سلامت داده شده و این مهر همچنان ادامه
                                دارد</p>
                            <div class="projects-masonry__details-holder">
                                <div class="projects-masonry__details-item">
                                    <span>مهرینو: </span><span>1.300.000.000</span></div>
                                <div class="projects-masonry__details-item"><span>تاریخ: </span><span>تیر 1399</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="col-lg-6 col-xl-8 projects-masonry__item projects-masonry__item--height-1 projects-masonry__item--primary">
                    <div class="projects-masonry__img"><img class="img--bg" src="img/projects_3.jpg" alt="img"/>
                        <div class="projects-masonry__inner"><span class="projects-masonry__badge"
                                                                   style="background: #F8AC3A;">غذا و دارو</span>
                            <h3 class="projects-masonry__title"><a href="cause-details.html">ساخت تولیدی های خوراک</a>
                            </h3>
                            <p>افزایش کارگاه ها و خارخانجات تولیدی خوراک و بسته بندی مواد غذایی </p>
                            <div class="projects-masonry__details-holder">
                                <div class="projects-masonry__details-item"><span>مهرینو: </span><span>2.100.000.000 تومان</span>
                                </div>
                                <div class="projects-masonry__details-item"><span>تاریخ: </span><span>شهریور 1399</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="col-lg-6 col-xl-4 projects-masonry__item projects-masonry__item--height-2 projects-masonry__item--primary">
                    <div class="projects-masonry__img"><img class="img--bg" src="img/projects_4.jpg" alt="img"/>
                        <div class="projects-masonry__inner"><span class="projects-masonry__badge"
                                                                   style="background: #2EC774;">آموزش و پرورش</span>
                            <h3 class="projects-masonry__title"><a href="cause-details.html">احدات 7 مدرسه و ساختمان
                                    آموزشی</a></h3>
                            <p>ساخت مدرسه و دبیرستان و پیشدانشگاهی در شهر های دور افتاده نیازمند و طالب علم </p>
                            <div class="projects-masonry__details-holder">
                                <div class="projects-masonry__details-item"><span>مهرینو: </span><span>3.550.000.000 تومان</span>
                                </div>
                                <div class="projects-masonry__details-item"><span>تاریخ: </span><span>شهریور 1399</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="col-lg-6 col-xl-8 projects-masonry__item projects-masonry__item--height-2 projects-masonry__item--horizontal">
                    <div class="projects-masonry__img"><img class="img--bg" src="img/projects_5.jpg" alt="img"/></div>
                    <div class="projects-masonry__text" style="background-color: #E78F51;">
                        <div class="projects-masonry__inner"><span class="projects-masonry__badge"
                                                                   style="background: #2EC774;">آموزش</span>
                            <h3 class="projects-masonry__title"><a href="cause-details.html">احداث و تجهیز مدارس بازسازی
                                    شده</a></h3>
                            <p>احداث و تجهیز مدارس تخریب شده شهر های زلزله زده کرمانشاه در زلزله اخیر</p>
                            <div class="projects-masonry__details-holder">
                                <div class="projects-masonry__details-item">
                                    <span>مهرینو: </span><span>1.650.000.000</span></div>
                                <div class="projects-masonry__details-item"><span>تاریخ: </span><span>خرداد 1399</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="col-lg-6 col-xl-4 projects-masonry__item projects-masonry__item--height-2 projects-masonry__item--primary">
                    <div class="projects-masonry__img"><img class="img--bg" src="img/projects_6.jpg" alt="img"/>
                        <div class="projects-masonry__inner"><span class="projects-masonry__badge"
                                                                   style="background: #F36F8F;">درمانی</span>
                            <h3 class="projects-masonry__title"><a href="cause-details.html">احداث خانه بهداست در 163
                                    روستا</a></h3>
                            <p>وجود خانه بهداشت در مناطق روستایی برای بالابردن سطح سلامت و بهداشت روستا ها</p>
                            <div class="projects-masonry__details-holder">
                                <div class="projects-masonry__details-item">
                                    <span>مهرینو: </span><span>890.000.000 تومان</span></div>
                                <div class="projects-masonry__details-item"><span>تاریخ: </span><span>تیر 1399</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- projects end-->
        <!-- events start-->
{{--        <section class="section events"><img class="events__bg" src="img/events_bg.png" alt="img"/>--}}
{{--            <div class="container">--}}
{{--                <div class="row margin-bottom">--}}
{{--                    <div class="col-12">--}}
{{--                        <div class="heading heading--primary heading--center"><span--}}
{{--                                class="heading__pre-title">Events</span>--}}
{{--                            <h2 class="heading__title"><span>Helpo Holds</span> <span>for You</span></h2>--}}
{{--                            <p class="no-margin-bottom">Sharksucker sea toad candiru rocket danio tilefish stingray--}}
{{--                                deepwater stingray Sacramento splittail, Canthigaster rostrata. Midshipman dartfish</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-6 col-lg-4">--}}
{{--                        <div class="event-item">--}}
{{--                            <div class="event-item__img"><img class="img--bg" src="img/event_1.jpg" alt="img"/></div>--}}
{{--                            <div class="event-item__content">--}}
{{--                                <h6 class="event-item__title"><a href="#">Help for Language. Voluanteer</a></h6>--}}
{{--                                <p><b>Dark Spurt,</b> San Francisco, CA 94528, USA</p>--}}
{{--                                <p><b>September 30 - October 31,</b> 2019</p>--}}
{{--                                <p><b>10:00 AM - 18:00 PM,</b> Everyday</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6 col-lg-4">--}}
{{--                        <div class="event-item">--}}
{{--                            <div class="event-item__img"><img class="img--bg" src="img/event_2.jpg" alt="img"/></div>--}}
{{--                            <div class="event-item__content">--}}
{{--                                <h6 class="event-item__title"><a href="#">The Culture of Africa. Rebirth</a></h6>--}}
{{--                                <p><b>Dark Spurt,</b> San Francisco, CA 94528, USA</p>--}}
{{--                                <p><b>September 30 - October 31,</b> 2019</p>--}}
{{--                                <p><b>10:00 AM - 18:00 PM,</b> Everyday</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6 col-lg-4">--}}
{{--                        <div class="event-item">--}}
{{--                            <div class="event-item__img"><img class="img--bg" src="img/event_3.jpg" alt="img"/></div>--}}
{{--                            <div class="event-item__content">--}}
{{--                                <h6 class="event-item__title"><a href="#">Help for Language. Voluanteer</a></h6>--}}
{{--                                <p><b>Dark Spurt,</b> San Francisco, CA 94528, USA</p>--}}
{{--                                <p><b>April 15 - April 20,</b> 2019</p>--}}
{{--                                <p><b>10:00 AM - 15:00 PM,</b> Everyday</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12 text-center"><a class="button button--primary" href="#">View all events</a></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
        <!-- events end-->
        <!-- text section start-->
        <section class="section text-section" id="download-app"><img class="text-section__bg" src="img/text-section.png" alt="img"/>
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="text-section__heading">Application</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-4 col-xl-7 offset-xl-4">
                        <h3 class="text-section__title">لینک دانلود اپلیکیشن مهرینو<br/>
                        </h3>
{{--                        <p>Sharksucker sea toad candiru rocket danio tilefish stingray deepwater stingray Sacramento--}}
{{--                            splittail, Canthigaster rostrata. Midshipman dartfish Modoc sucker, yellowtail kingfish</p>--}}
                        <a class="button button--primary" href="#">دانلود مستقیم</a>
                        <a class="button button--primary" href="#">دانلود از بازار</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- text section end-->
        <!-- testimonials style-2 start-->
{{--        <section class="section testimonials--style-2">--}}
{{--            <div class="testimonials--style-2__bg jarallax">--}}
{{--                <picture>--}}
{{--                    <source srcset="img/testimonials_2.jpg" media="(min-width: 992px)"/>--}}
{{--                    <img class="jarallax-img" src="img/testimonials_2.jpg" alt="img"/>--}}
{{--                </picture>--}}
{{--            </div>--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-xl-4">--}}
{{--                        <div class="heading heading--primary"><span class="heading__pre-title">Testimonials</span>--}}
{{--                            <h2 class="heading__title"><span>What People</span><br/><span>Says About Us</span></h2>--}}
{{--                        </div>--}}
{{--                        <!-- slider nav start-->--}}
{{--                        <div class="slider__nav testimonials-style-2__nav">--}}
{{--                            <div class="slider__arrows">--}}
{{--                                <div class="slider__prev"><i class="fa fa-chevron-left" aria-hidden="true"></i>--}}
{{--                                </div>--}}
{{--                                <div class="slider__next"><i class="fa fa-chevron-right" aria-hidden="true"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- slider nav end-->--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-8">--}}
{{--                        <div class="testimonials-slider testimonials-slider--style-2">--}}
{{--                            <div class="testimonials-slider__item">--}}
{{--                                <div class="testimonials-slider__icon">“</div>--}}
{{--                                <div class="testimonials-slider__text">--}}
{{--                                    <p>Slickhead grunion lake trout. Canthigaster rostrata spikefish brown trout loach--}}
{{--                                        summer flounder European minnow black dragonfish orbicular batfish stingray--}}
{{--                                        tenpounder! Flying characin herring, Moses sole sea snail grouper discus.--}}
{{--                                        European eel slender snipe eel. Gulper eel dealfish ocean sunfish; rohu--}}
{{--                                        yellow-and-black triplefin Atlantic saury swordfish southern sandfish Rudderfish--}}
{{--                                        long-finned pikerazorfish menhaden paradise fish, barramundi oceanic flyingfish.--}}
{{--                                        Fangtooth yellowtail banded killifish seamoth triplefin blenny desert pupfish--}}
{{--                                        crocodile shark catfish cutlassfish broadband dogfish whalefish.</p>--}}
{{--                                    <div class="testimonials-slider__author"><span class="testimonials-slider__name">Jack Wolfskin, </span><span--}}
{{--                                            class="testimonials-slider__position">Volunteer</span></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="testimonials-slider__item">--}}
{{--                                <div class="testimonials-slider__icon">“</div>--}}
{{--                                <div class="testimonials-slider__text">--}}
{{--                                    <p>Slickhead grunion lake trout. Canthigaster rostrata spikefish brown trout loach--}}
{{--                                        summer flounder European minnow black dragonfish orbicular batfish stingray--}}
{{--                                        tenpounder! Flying characin herring, Moses sole sea snail grouper discus.--}}
{{--                                        European eel slender snipe eel. Gulper eel dealfish ocean sunfish; rohu--}}
{{--                                        yellow-and-black triplefin Atlantic saury swordfish southern sandfish Rudderfish--}}
{{--                                        long-finned pikerazorfish menhaden paradise fish, barramundi oceanic flyingfish.--}}
{{--                                        Fangtooth yellowtail banded killifish seamoth triplefin blenny desert pupfish--}}
{{--                                        crocodile shark catfish cutlassfish broadband dogfish whalefish.</p>--}}
{{--                                    <div class="testimonials-slider__author"><span class="testimonials-slider__name">Jack Wolfskin, </span><span--}}
{{--                                            class="testimonials-slider__position">Volunteer</span></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="testimonials-slider__item">--}}
{{--                                <div class="testimonials-slider__icon">“</div>--}}
{{--                                <div class="testimonials-slider__text">--}}
{{--                                    <p>Slickhead grunion lake trout. Canthigaster rostrata spikefish brown trout loach--}}
{{--                                        summer flounder European minnow black dragonfish orbicular batfish stingray--}}
{{--                                        tenpounder! Flying characin herring, Moses sole sea snail grouper discus.--}}
{{--                                        European eel slender snipe eel. Gulper eel dealfish ocean sunfish; rohu--}}
{{--                                        yellow-and-black triplefin Atlantic saury swordfish southern sandfish Rudderfish--}}
{{--                                        long-finned pikerazorfish menhaden paradise fish, barramundi oceanic flyingfish.--}}
{{--                                        Fangtooth yellowtail banded killifish seamoth triplefin blenny desert pupfish--}}
{{--                                        crocodile shark catfish cutlassfish broadband dogfish whalefish.</p>--}}
{{--                                    <div class="testimonials-slider__author"><span class="testimonials-slider__name">Jack Wolfskin, </span><span--}}
{{--                                            class="testimonials-slider__position">Volunteer</span></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
        <!-- testimonials style-2 end-->
        <!-- blog start-->





@if ($weblogs->count() > 0)
        <section class="section blog">
            <img class="blog__bg" src="{{ asset('img/blog_bg.png') }}" alt="blog"/>
            <div class="container">
                <div class="row margin-bottom">
                    <div class="col-12">
                        <div class="heading heading--primary heading--center">
                            <h2 class="heading__title no-margin-bottom">
                                <span>وبلاگ</span>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="row offset-margin">
                    @foreach($weblogs as $weblog)
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="blog-item blog-item--style-1">
                                <div class="blog-item__img">
                                    <img class="img--bg" src="{{ getBaseUri($weblog->cover) }}" alt="{{ $weblog->title }}"/>
                                    <span class="blog-item__badge" style="background-color: #49C2DF;">{{ $weblog->categories()->first()->title }}</span>
                                </div>
                                <div class="blog-item__content">
                                    <h6 class="blog-item__title">
                                        <a href="#">{{ $weblog->title }}</a>
                                    </h6>
                                    <p>
                                        {{ Str::limit($weblog->abstract , 100) }}
                                    </p>
                                    <div class="blog-item__details">
                                        <span class="blog-item__date">{{ jdate($weblog->created_at)->format('%A, %d %B %y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
@endif











{{--        <section class="section blog"><img class="blog__bg" src="img/blog_bg.png" alt="img"/>--}}
{{--            <div class="container">--}}
{{--                <div class="row margin-bottom">--}}
{{--                    <div class="col-12">--}}
{{--                        <div class="heading heading--primary heading--center"><span--}}
{{--                                class="heading__pre-title">News</span>--}}
{{--                            <h2 class="heading__title no-margin-bottom"><span>Helpo</span> <span>Blog</span></h2>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row offset-margin">--}}
{{--                    <div class="col-md-6 col-lg-5 col-xl-4">--}}
{{--                        <div class="blog-item blog-item--style-1">--}}
{{--                            <div class="blog-item__img"><img class="img--bg" src="img/blog_1.jpg" alt="img"/><span--}}
{{--                                    class="blog-item__badge" style="background-color: #49C2DF;">Water Delivery</span>--}}
{{--                            </div>--}}
{{--                            <div class="blog-item__content">--}}
{{--                                <h6 class="blog-item__title"><a href="#">Save the Children's Role in Fight Against--}}
{{--                                        Malnutrition Hailed</a></h6>--}}
{{--                                <p>Sharksucker sea toad candiru rocket danio tilefish stingray deepwater stingray--}}
{{--                                    Sacramento splittail canthigaster</p>--}}
{{--                                <div class="blog-item__details"><span class="blog-item__date">23 Jan' 19</span><span>--}}
{{--											<svg class="icon">--}}
{{--												<use xlink:href="#comment"></use>--}}
{{--											</svg> 501</span></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6 col-lg-7 col-xl-8">--}}
{{--                        <div class="blog-item blog-item--style-2"><img class="img--bg" src="img/blog_2.png" alt="img"/>--}}
{{--                            <div class="blog-item__content"><span class="blog-item__badge"--}}
{{--                                                                  style="background-color: #2EC774;">Education</span>--}}
{{--                                <h6 class="blog-item__title"><a href="#">Back to the future: Quality education through--}}
{{--                                        respect, commitment and accountability</a></h6>--}}
{{--                                <p>Sharksucker sea toad candiru rocket danio tilefish stingray deepwater stingray--}}
{{--                                    Sacramento splittail canthigaster rostrata. Midshipman dartfish Modoc sucker,--}}
{{--                                    yellowtail</p>--}}
{{--                            </div>--}}
{{--                            <div class="blog-item__details"><span class="blog-item__date">23 Jan' 19</span><span>--}}
{{--										<svg class="icon">--}}
{{--											<use xlink:href="#comment"></use>--}}
{{--										</svg> 501</span></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6 col-lg-7 col-xl-8">--}}
{{--                        <div class="blog-item blog-item--style-2"><img class="img--bg" src="img/blog_3.png" alt="img"/>--}}
{{--                            <div class="blog-item__content"><span class="blog-item__badge"--}}
{{--                                                                  style="background-color: #F8AC3A;">Food</span>--}}
{{--                                <h6 class="blog-item__title"><a href="#">Condolences to Families Effected By Flash--}}
{{--                                        Floods in Setswetla, Alexandra Township, Johannesburg</a></h6>--}}
{{--                                <p>Sharksucker sea toad candiru rocket danio tilefish stingray deepwater stingray--}}
{{--                                    Sacramento splittail canthigaster rostrata. Midshipman dartfish Modoc sucker,--}}
{{--                                    yellowtail</p>--}}
{{--                            </div>--}}
{{--                            <div class="blog-item__details"><span class="blog-item__date">23 Jan' 19</span><span>--}}
{{--										<svg class="icon">--}}
{{--											<use xlink:href="#comment"></use>--}}
{{--										</svg> 501</span></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6 col-lg-5 col-xl-4">--}}
{{--                        <div class="blog-item blog-item--style-1">--}}
{{--                            <div class="blog-item__img"><img class="img--bg" src="img/blog_4.png" alt="img"/><span--}}
{{--                                    class="blog-item__badge" style="background-color: #F36F8F;">Medicine</span></div>--}}
{{--                            <div class="blog-item__content">--}}
{{--                                <h6 class="blog-item__title"><a href="#">Save the Children's Role in Fight Against--}}
{{--                                        Malnutrition Hailed</a></h6>--}}
{{--                                <p>Sharksucker sea toad candiru rocket danio tilefish stingray deepwater stingray--}}
{{--                                    Sacramento splittail canthigaster</p>--}}
{{--                                <div class="blog-item__details"><span class="blog-item__date">23 Jan' 19</span><span>--}}
{{--											<svg class="icon">--}}
{{--												<use xlink:href="#comment"></use>--}}
{{--											</svg> 501</span></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
        <!-- blog end-->
        <!-- donors start-->
{{--        <section class="section donors no-padding-top">--}}
{{--            <div class="container">--}}
{{--                <div class="row margin-bottom">--}}
{{--                    <div class="col-12">--}}
{{--                        <div class="heading heading--primary heading--center"><span--}}
{{--                                class="heading__pre-title">Donors</span>--}}
{{--                            <h2 class="heading__title no-margin-bottom"><span>Who Help</span> <span>Us</span></h2>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12">--}}
{{--                        <!-- donors slider start-->--}}
{{--                        <div class="slider-holder">--}}
{{--                            <div class="donors-slider donors-slider--style-1">--}}
{{--                                <div class="donors-slider__item">--}}
{{--                                    <div class="donors-slider__img"><img src="img/donor_1.png" alt="donor"/></div>--}}
{{--                                </div>--}}
{{--                                <div class="donors-slider__item">--}}
{{--                                    <div class="donors-slider__img"><img src="img/donor_2.png" alt="donor"/></div>--}}
{{--                                </div>--}}
{{--                                <div class="donors-slider__item">--}}
{{--                                    <div class="donors-slider__img"><img src="img/donor_3.png" alt="donor"/></div>--}}
{{--                                </div>--}}
{{--                                <div class="donors-slider__item">--}}
{{--                                    <div class="donors-slider__img"><img src="img/donor_4.png" alt="donor"/></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- donors slider end-->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
        <!-- donors end-->
        <!-- instagram start-->
{{--        <section class="section instagram no-padding-bottom">--}}
{{--            <div class="container">--}}
{{--                <div class="row align-items-end margin-bottom">--}}
{{--                    <div class="col-md-7 col-lg-8">--}}
{{--                        <div class="heading heading--primary"><span--}}
{{--                                class="heading__pre-title">به جمع حامیان ما بپیوندید</span>--}}
{{--                            <h2 class="heading__title no-margin-bottom"><span># مهرینو</span></h2>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-5 col-lg-4 text-md-right">--}}
{{--                        <!-- slider nav start-->--}}
{{--                        <div class="slider__nav instagram-slider__nav">--}}
{{--                            <div class="slider__arrows">--}}
{{--                                <div class="slider__prev"><i class="fa fa-chevron-left" aria-hidden="true"></i>--}}
{{--                                </div>--}}
{{--                                <div class="slider__next"><i class="fa fa-chevron-right" aria-hidden="true"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- slider nav end-->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="instagram-slider"><a class="instagram-slider__item" href="#"><img class="img--bg"--}}
{{--                                                                                          src="img/ig_1.jpg" alt="img"/><span--}}
{{--                        class="instagram-slider__icon"><i class="fa fa-instagram" aria-hidden="true"></i></span><span--}}
{{--                        class="instagram-slider__icon-hover"><i class="fa fa-instagram"--}}
{{--                                                                aria-hidden="true"></i></span></a><a--}}
{{--                    class="instagram-slider__item" href="#"><img class="img--bg" src="img/ig_2.jpg" alt="img"/><span--}}
{{--                        class="instagram-slider__icon"><i class="fa fa-instagram" aria-hidden="true"></i></span><span--}}
{{--                        class="instagram-slider__icon-hover"><i class="fa fa-instagram"--}}
{{--                                                                aria-hidden="true"></i></span></a><a--}}
{{--                    class="instagram-slider__item" href="#"><img class="img--bg" src="img/ig_3.jpg" alt="img"/><span--}}
{{--                        class="instagram-slider__icon"><i class="fa fa-instagram" aria-hidden="true"></i></span><span--}}
{{--                        class="instagram-slider__icon-hover"><i class="fa fa-instagram"--}}
{{--                                                                aria-hidden="true"></i></span></a><a--}}
{{--                    class="instagram-slider__item" href="#"><img class="img--bg" src="img/ig_4.jpg" alt="img"/><span--}}
{{--                        class="instagram-slider__icon"><i class="fa fa-instagram" aria-hidden="true"></i></span><span--}}
{{--                        class="instagram-slider__icon-hover"><i class="fa fa-instagram"--}}
{{--                                                                aria-hidden="true"></i></span></a><a--}}
{{--                    class="instagram-slider__item" href="#"><img class="img--bg" src="img/ig_5.jpg" alt="img"/><span--}}
{{--                        class="instagram-slider__icon"><i class="fa fa-instagram" aria-hidden="true"></i></span><span--}}
{{--                        class="instagram-slider__icon-hover"><i class="fa fa-instagram"--}}
{{--                                                                aria-hidden="true"></i></span></a><a--}}
{{--                    class="instagram-slider__item" href="#"><img class="img--bg" src="img/ig_6.jpg" alt="img"/><span--}}
{{--                        class="instagram-slider__icon"><i class="fa fa-instagram" aria-hidden="true"></i></span><span--}}
{{--                        class="instagram-slider__icon-hover"><i class="fa fa-instagram"--}}
{{--                                                                aria-hidden="true"></i></span></a><a--}}
{{--                    class="instagram-slider__item" href="#"><img class="img--bg" src="img/ig_4.jpg" alt="img"/><span--}}
{{--                        class="instagram-slider__icon"><i class="fa fa-instagram" aria-hidden="true"></i></span><span--}}
{{--                        class="instagram-slider__icon-hover"><i class="fa fa-instagram"--}}
{{--                                                                aria-hidden="true"></i></span></a></div>--}}
{{--        </section>--}}
        <!-- instagram end-->
        <!-- subscribe start-->
{{--        <section class="subscribe">--}}
{{--            <div class="container">--}}
{{--                <div class="row align-items-end">--}}
{{--                    <div class="col-lg-4">--}}
{{--                        <h2 class="subscribe__title">خبرنامه.</h2>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-8">--}}
{{--                        <form class="subscribe-form" action="javascript:void(0);">--}}
{{--                            <input class="subscribe-form__input" type="email" name="email"--}}
{{--                                   placeholder="ایمیل خود را وارد کنید" required="required"/>--}}
{{--                            <input class="subscribe-form__submit" type="submit" value="ارسال"/>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
        <!-- subscribe end-->
    </main>
@endsection
