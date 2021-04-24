import React, { Fragment, useEffect, useState, useContext } from 'react';
import { useHistory } from 'react-router-dom';
import _ from "lodash";
import CardIcon from '../components/Card/CardIcon';
import { CategoryContext } from '../context';
import MasterPage from '../Layouts/Master/Master';
import { fetchHome } from './../api/index';
import { typeIcon } from "../Enum";
import { Spinner } from "../components/Spinner/Spinner";

export default function Home(props) {

    const { home, setHome, page, setPage } = useContext(CategoryContext);

    const [ data, setData ] = useState([]);
    const [ loading, setLoading ] = useState(false);

    const history = useHistory();

    const handleFetchData = async () => {
        setLoading(true);
        const res = await fetchHome();
        if (res) {
            setHome(res);
            // temporary
            const items = _.get(res, "data").filter(r => r.type !== 0 && r.type !== 1 && r.type !== 7)
            setData(items);
        }
        setLoading(false);
    }
    useEffect(() => {
        handleFetchData();
    }, []);


    const handleClickCategory = (data) => {
        console.log('clickd', data);
        setPage(1);
        _.get(_.find(typeIcon, function (obj) {
            if (obj.type === data.type) {
                history.push(obj.route);
            }
        }))
    }

    console.log('data', home)
    return (
        <MasterPage >
            <div className="main">
                {/*hero section start*/}
                <section className="ptb-100 bg-image overflow-hidden" image-overlay={10}>
                    <div className="hero-bottom-shape-two" style={{ background: 'url("assets/img/hero-bottom-shape-2.svg")no-repeat bottom center' }} />
                    <div className="container">
                        <div className="row align-items-center justify-content-lg-between justify-content-md-center justify-content-sm-center">
                            <div className="col-md-12 col-lg-6">
                                <div className="hero-slider-content text-white py-5">
                                    <h1 className="text-white">هیربد، پلتفرم تخصصی آموزشی</h1>
                                    <p className="lead">هیربد، اولین پلتفرم تخصصی آموزشی کشور با تکیه بر دانش تخصصی جوانان دانشگاه شریف و تجربه اساتید برتر کشور طراحی، تولید و ارایه شده است. ما در هیربد بدنبال ارتقای اکوسیستم آموزشی کشور هستیم.</p>
                                    <div className="action-btns mt-4">
                                        <ul className="list-inline">
                                            <li className="list-inline-item">
                                                <a href="https://hirbod.ac/latest.apk" className="d-flex align-items-center app-download-btn btn btn-white btn-rounded">
                                                    <span className="fab fa-dropbox icon-size-sm mr-3 color-primary" />
                                                    <div className="download-text text-left">
                                                        <small>دانلود</small>
                                                        <h5 className="mb-0">سرور هیربد</h5>
                                                    </div>
                                                </a>
                                            </li>
                                            <li className="list-inline-item">
                                                <a href="#" className="d-flex align-items-center app-download-btn btn btn-white btn-rounded">
                                                    <span className="fab fa-google-play icon-size-sm mr-3 color-primary" />
                                                    <div className="download-text text-left">
                                                        <small>دانلود</small>
                                                        <h5 className="mb-0">گوگل پلی</h5>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div className="hero-counter mt-4">
                                        <div className="row">
                                            <div className="col-6 col-sm-4">
                                                <div className="counter-item d-flex align-items-center py-3">
                                                    <div className="single-counter-item">
                                                        <span className="h4 count-number text-white">61,086</span>
                                                        <h6 className="text-white mb-0">مجموع نصب</h6>
                                                    </div>
                                                    <span className="color-6 ml-2 p-2 rounded-circle">
                                                        <i className="fas fa-arrow-up icon-sm" />
                                                    </span>
                                                </div>
                                            </div>
                                            <div className="col-6 col-sm-4">
                                                <div className="counter-item d-flex align-items-center py-3">
                                                    <div className="single-counter-item">
                                                        <span className="h4 count-number text-white">143,870</span>
                                                        <h6 className="text-white mb-0">مجموع دانلود</h6>
                                                    </div>
                                                    <span className="color-6 ml-2 p-2 rounded-circle">
                                                        <i className="fas fa-arrow-up icon-sm" />
                                                    </span>
                                                </div>
                                            </div>
                                            <div className="col-6 col-sm-4">
                                                <div className="counter-item d-flex align-items-center py-3">
                                                    <div className="single-counter-item">
                                                        <span className="h4 count-number text-white">31,191</span>
                                                        <h6 className="text-white mb-0">کاربران فعال</h6>
                                                    </div>
                                                    <span className="color-6 ml-2 p-2 rounded-circle">
                                                        <i className="fas fa-arrow-up icon-sm" />
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-6 col-sm-6 col-lg-5">
                                <div className="img-wrap">
                                    <img src="assets/img/app-mobile-image.png" alt="تصویر برنامه" className="img-fluid" />
                                </div>
                            </div>
                        </div>
                        {/*end of row*/}
                    </div>
                    {/*end of container*/}
                </section>
                {/*hero section end*/}
                {/*promo section start*/}

                {/* ==============================================
                    home
                ============================================== */}
                <section className="promo-section ptb-100">
                    <div className="container">
                        <div className="row">
                            {loading && <Spinner />}
                            {!loading &&
                                data.map(d =>
                                    <div className="col-md-6 col-lg-3" key={d.uuid}>
                                        <CardIcon data={d} key={d.uuid} handleClickCategory={handleClickCategory} />
                                    </div>)
                            }

                        </div>
                    </div>
                </section>
                {/* =================================================== */}

                {/*promo section end*/}
                {/*about us section start*/}
                <div className="overflow-hidden">
                    {/*about us section start*/}
                    <section id="about" className="about-us ptb-100 background-shape-img position-relative">
                        <div className="animated-shape-wrap">
                            <div className="animated-shape-item" />
                            <div className="animated-shape-item" />
                            <div className="animated-shape-item" />
                            <div className="animated-shape-item" />
                            <div className="animated-shape-item" />
                        </div>
                        <div className="container">
                            <div className="row align-items-center justify-content-lg-between justify-content-md-center justify-content-sm-center">
                                <div className="col-md-12 col-lg-6 mb-5 mb-md-5 mb-sm-5 mb-lg-0">
                                    <div className="about-content-left">
                                        <h2>هیربد، پلتفرم تخصصی آموزشی</h2>
                                        <p>ما در هیربد راهکاری‌ها و زیرساخت‌های آموزشی پایدار و مختص اکوسیستم آموزشی ارایه می‌کنیم. همه آنچه برای دانش‌پذیری و دانش‌گستری نیاز دارید در دست شماست.</p>
                                        <ul className="dot-circle pt-3">
                                            <li>امکان محافظت از محتوای شما تا ۹۹٪</li>
                                            <li>امکان خرید جلسه‌ای دوره‌های آموزشی</li>
                                            <li>پشتیبانی کامل ۷ روز هفته بصورت ۲۴ ساعته</li>
                                            <li>امکان تماس گروهی تصویری و صوتی</li>
                                            <li>ارایه مدارک دانشگاهی رسمی و معرفی برای کار</li>
                                            <li>برگشت کامل وجه در صورت نارضایتی بصورت کامل بصورت سیستمی</li>
                                        </ul>
                                        <div className="row pt-3">
                                            <div className="col-4 col-lg-3 border-right">
                                                <div className="count-data text-center">
                                                    <h4 className="count-number mb-0 color-primary font-weight-bold">1023</h4>
                                                    <span>مشتریان</span>
                                                </div>
                                            </div>
                                            <div className="col-4 col-lg-3 border-right">
                                                <div className="count-data text-center">
                                                    <h4 className="count-number mb-0 color-primary font-weight-bold">5470</h4>
                                                    <span>دوره آموزشی</span>
                                                </div>
                                            </div>
                                            <div className="col-4 col-lg-3 border-right">
                                                <div className="count-data text-center">
                                                    <h4 className="count-number mb-0 color-primary font-weight-bold">3560</h4>
                                                    <span>رضایت مشتری</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-sm-5 col-md-5 col-lg-4">
                                    <div className="about-content-right">
                                        <img src="assets/img/app-mobile-image-2.png" alt="درباره ما" className="img-fluid" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    {/*about us section end*/}
                </div>
                <section className="position-relative feature-section ptb-100">
                    <div className="container">
                        <div className="row align-items-center justify-content-between justify-content-sm-center justify-content-md-center">
                            <div className="col-sm-5 col-md-6 col-lg-6 mb-5 mb-md-5 mb-sm-5 mb-lg-0">
                                <div className="download-img">
                                    <img src="assets/img/app-mobile-image3.png" alt="دانلود" className="img-fluid" />
                                </div>
                            </div>
                            <div className="col-md-12 col-lg-6">
                                <div className="feature-contents">
                                    <h2>هیربد، بزرگترین شبکه آموزشی کشور</h2>
                                    <p>آموزش در کنار ارتباط و گسترش ارتباطات در زمینه رشد کاربران هیربد از اهداف اصلی تیم ماست. هیربد یک گام فراتر رفته و بر روی ارتباطات بعد از آموزش نیز توجه کرده است.</p>
                                    <ul className="dot-circle pt-2">
                                        <li>ارتباط مستقیم با استاد</li>
                                        <li>ارتباط با هم‌دوره و همکلاسی‌ها</li>
                                        <li>ارتباط با فارغ التحصیلان و باتجربه‌های هیربد</li>
                                        <li>ارتباط با مدیران شرکتی در حال آموزش</li>
                                    </ul>
                                    <div className="action-btns mt-4">
                                        <a href="#" className="btn btn-brand-02 mr-3">نصب می‌کنم </a>
                                        <a href="#" className="btn btn-outline-brand-02"> آشنا می‌شوم </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {/*about us section end*/}
                {/*download section step start*/}
                <section className="bg-image ptb-100" image-overlay={8}>
                    <div className="background-image-wraper" style={{ background: 'url("assets/img/cta-bg.jpg")no-repeat center center / cover fixed', opacity: 1 }} />
                    <div className="container">
                        <div className="row justify-content-center">
                            <div className="col-md-9 col-lg-8">
                                <div className="section-heading text-center mb-1 text-white">
                                    <h2 className="text-white">هم‌اکنون هیربد را نصب کنید!</h2>
                                    <p>ما برای راحتی و سرعت آموزش شما تمام معماری خود را بر اپلیکیشن‌های موبایل متمرکز ساخته‌ایم.</p>
                                    <div className="action-btns mt-4">
                                        <ul className="list-inline">
                                            <li className="list-inline-item">
                                                <a href="#" className="d-flex align-items-center app-download-btn btn btn-brand-02 btn-rounded">
                                                    <span className="fab fa-windows icon-size-sm mr-3" />
                                                    <div className="download-text text-left">
                                                        <small>دانلود هیربد</small>
                                                        <h5 className="mb-0">کافه بازار</h5>
                                                    </div>
                                                </a>
                                            </li>
                                            <li className="list-inline-item">
                                                <a href="#" className="d-flex align-items-center app-download-btn btn btn-brand-02 btn-rounded">
                                                    <span className="fab fa-apple icon-size-sm mr-3" />
                                                    <div className="download-text text-left">
                                                        <small>دانلود هیربد</small>
                                                        <h5 className="mb-0">اپل استور</h5>
                                                    </div>
                                                </a>
                                            </li>
                                            <li className="list-inline-item">
                                                <a href="#" className="d-flex align-items-center app-download-btn btn btn-brand-02 btn-rounded">
                                                    <span className="fab fa-google-play icon-size-sm mr-3" />
                                                    <div className="download-text text-left">
                                                        <small>دانلود هیربد</small>
                                                        <h5 className="mb-0">گوگل پلی</h5>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {/*end col*/}
                        </div>
                        {/*end row*/}
                    </div>
                </section>
                {/*download section step end*/}
                {/*features section start*/}
                <div id="features" className="feature-section ptb-100 ">
                    <div className="container">
                        <div className="row justify-content-center">
                            <div className="col-md-9 col-lg-9">
                                <div className="section-heading text-center mb-5">
                                    <h2>ویژگی‌های هیربد</h2>
                                    <p>تلاش ما در ساخت هیربد، به عنوان پلتفرم تخصصی اکوسیستم آموزشی کشور بر راحتی، سادگی و نتیجه‌گرا بودن خروجی استفاده از هیربد بوده است.</p>
                                </div>
                            </div>
                        </div>
                        {/*feature new style start*/}
                        <div className="row align-items-center justify-content-md-center">
                            <div className="col-lg-4 col-md-12">
                                <div className="row">
                                    <div className="col-12">
                                        <div className="d-flex align-items-start mb-sm-0 mb-md-3 mb-lg-3">
                                            <span className="ti-face-smile icon-size-md color-secondary mr-4" />
                                            <div className="icon-text">
                                                <h5 className="mb-2">طراحی کاربرپسند</h5>
                                                <p>ساعت‌ها زمان صرف طراحی رابط کاربری اپلیکیشن جهت استفاده راحت و ساده از هیربد صرف شده است.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="col-12">
                                        <div className="d-flex align-items-start mb-sm-0 mb-md-3 mb-lg-3">
                                            <span className="ti-vector icon-size-md color-secondary mr-4" />
                                            <div className="icon-text">
                                                <h5 className="mb-2">پاسخگویی بالا</h5>
                                                <p>با توجه به چشم‌انداز هیربد ما همواره برای مقیاس‌پذیری و ارایه خدمات در سطح بسیار بالاتر کاربران آماده هستیم.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="col-12">
                                        <div className="d-flex align-items-start mb-sm-0 mb-md-3 mb-lg-3">
                                            <span className="ti-headphone-alt icon-size-md color-secondary mr-4" />
                                            <div className="icon-text">
                                                <h5 className="mb-2">پشتیبانی آنلاین دوستانه</h5>
                                                <p>همواره شنیدیم که فروش آغاز تعهد است. ما این جمله را در هیربد برای شما به یک تجربه شیرین و واقعی تبدیل می‌کنیم. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="col-lg-4 col-md-5 d-none d-sm-none d-md-block d-lg-block">
                                <div className="position-relative pb-md-5 py-lg-0">
                                    <img alt="هیربد" src="assets/img/app-mobile-image.png" className="img-center img-fluid" />
                                </div>
                            </div>
                            <div className="col-lg-4 col-md-12">
                                <div className="row">
                                    <div className="col-12">
                                        <div className="d-flex align-items-start mb-sm-0 mb-md-3 mb-lg-3">
                                            <span className="ti-layout-media-right icon-size-md color-secondary mr-4" />
                                            <div className="icon-text">
                                                <h5 className="mb-2">سرعت بالای اجرا</h5>
                                                <p>ماه‌ها زمان برای طراحی معماری اختصاصی هیربد جهت اجرای سریع و پاسخگویی بالا برای استفاده تک تک کاربران صرف شده است.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="col-12">
                                        <div className="d-flex align-items-start mb-sm-0 mb-md-3 mb-lg-3">
                                            <span className="ti-layout-cta-right icon-size-md color-secondary mr-4" />
                                            <div className="icon-text">
                                                <h5 className="mb-2">صدور مدرک رسمی</h5>
                                                <p>ما در هیربد با همکاری یکی از دانشگاه ملی برای دوره‌های آموزشی مدرک رسمی قابل ترجمه و استعلام ارایه می‌کنیم. </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="col-12">
                                        <div className="d-flex align-items-start mb-sm-0 mb-md-3 mb-lg-3">
                                            <span className="ti-palette icon-size-md color-secondary mr-4" />
                                            <div className="icon-text">
                                                <h5 className="mb-2">شخصی‌سازی</h5>
                                                <p>یکی از ویژگی‌های جذاب هیربد امکان شخصی سازی تم و چینش محتوای داخل پلتفرم است. هیربد قابلیت شخصی‌سازی کامل دارد.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {/*feature new style end*/}
                    </div>
                </div>
                {/*features section end*/}
                {/*work process */}
                <section id="process" className="work-process-section position-relative  ptb-100 ">
                    <div className="container">
                        <div className="row justify-content-center">
                            <div className="col-md-9 col-lg-8">
                                <div className="section-heading text-center mb-5">
                                    <h2>دعوت به همکاری از اساتید و موسسات</h2>
                                    <p>آغوش گرم ما همواره بر روی فعالان اکوسیستم آموزشی کشور با لبخندی گرم فراهم است.</p>
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
                                                    <h5>ثبت‌نام و افزودن محصولات</h5>
                                                    <p>اولین گام ورود به جمع خانواده آموزشی هیربد، ثبت نام در پلتفرم است. پس از آن محصولات آموزشی خود را در پلتفرم بارگذاری کنید.</p>
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
                                                    <h5>فروش و پشتیبانی</h5>
                                                    <p>دومین قدم فروش محصولات و پشتیبانی دانش‌پذیران هیربدی است. یک قدم دیگر مانده است.</p>
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
                                                    <h5>رشد کنید!</h5>
                                                    <p>نظرات و فیدبک دانش پذیران در هیربد بصورت شگفت‌انگیزی می‌تواند به رشد ارگانیک و طبیعی شما کمک کند، هم‌چنین تیم فروش هیربد برای رشد شما، در کنار شماست.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-6 col-lg-6">
                                <div className="img-wrap">
                                    <img src="assets/img/app-mobile-image-3.png" alt="هیربد" className="img-fluid" />
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {/*work process end*/}
                {/*counter section start*/}
                <section className="counter-section gradient-bg ptb-40">
                    <div className="container">
                        <div className="row">
                            <div className="col-sm-6 col-md-6 col-lg-3">
                                <div className="text-white p-2 count-data text-center my-3">
                                    <span className="fas fa-users icon-size-lg mb-2" />
                                    <h3 className="count-number mb-1 text-white font-weight-bolder">21023</h3>
                                    <span>مشتریان</span>
                                </div>
                            </div>
                            <div className="col-sm-6 col-md-6 col-lg-3">
                                <div className="text-white p-2 count-data text-center my-3">
                                    <span className="fas fa-cloud-download-alt icon-size-lg mb-2" />
                                    <h3 className="count-number mb-1 text-white font-weight-bolder">44023</h3>
                                    <span>نصب فعال</span>
                                </div>
                            </div>
                            <div className="col-sm-6 col-md-6 col-lg-3">
                                <div className="text-white p-2 count-data text-center my-3">
                                    <span className="fas fa-smile icon-size-lg mb-2" />
                                    <h3 className="count-number mb-1 text-white font-weight-bolder">19023</h3>
                                    <span>رضایت مشتری</span>
                                </div>
                            </div>
                            <div className="col-sm-6 col-md-6 col-lg-3">
                                <div className="text-white p-2 count-data text-center my-3">
                                    <span className="fas fa-mug-hot icon-size-lg mb-2" />
                                    <h3 className="count-number mb-1 text-white font-weight-bolder">2323</h3>
                                    <span>هایپ مصرف‌شده</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {/*counter section end*/}
                {/*pricing section start*/}
                <section id="pricing" className="pricing-section ptb-100 gray-light-bg">
                    <div className="container">
                        <div className="row justify-content-center">
                            <div className="col-md-9 col-lg-8">
                                <div className="section-heading text-center mb-4">
                                    <h2>هیربد پلاس</h2>
                                    <p>هنوز تمام نشده است، هیربد پلاس نسل نوینی از خدمات آموزشی جهت دانش‌پذیری نوین است.</p>
                                </div>
                            </div>
                        </div>
                        <div className="row align-items-center justify-content-md-center justify-content-center">
                            <div className="col-lg-4 col-md-6 col-sm-8">
                                <div className="text-center bg-white single-pricing-pack mt-4">
                                    <div className="price-img pt-4">
                                        <img src="assets/img/priching-img-1.png" alt="هیربدپلاس" width={120} className="img-fluid" />
                                    </div>
                                    <div className="py-4 border-0 pricing-header">
                                        <div className="price text-center mb-0 monthly-price color-secondary" style={{ display: 'block' }}>299,000 تومان<span /></div>
                                    </div>
                                    <div className="price-name">
                                        <h5 className="mb-0">یک‌ماهه</h5>
                                    </div>
                                    <div className="pricing-content">
                                        <ul className="list-unstyled mb-4 pricing-feature-list">
                                            <li><span />دسترسی <span>محدود</span> به مدت یک ماه</li>
                                            <li><span>15</span> صفحه زیر را سفارشی کنید</li>
                                            <li className="text-deem"><span>105</span> فضای دیسک</li>
                                            <li className="text-deem"><span>3</span> دسترسی به دامنه</li>
                                            <li className="text-deem">پشتیبانی تلفنی 24/7</li>
                                        </ul>
                                        <a href="#" className="btn btn-outline-brand-02 btn-rounded mb-3" target="_blank">هم اکنون بخرید</a>
                                    </div>
                                </div>
                            </div>
                            <div className="col-lg-4 col-md-6 col-sm-8">
                                <div className="popular-price bg-white text-center single-pricing-pack mt-4">
                                    <div className="price-img pt-4">
                                        <img src="assets/img/priching-img-2.png" alt="قیمت" width={120} className="img-fluid" />
                                    </div>
                                    <div className="py-4 border-0 pricing-header">
                                        <div className="price text-center mb-0 monthly-price color-secondary" style={{ display: 'block' }}>799,000 تومان<span /></div>
                                    </div>
                                    <div className="price-name">
                                        <h5 className="mb-0">سه‌ماهه</h5>
                                    </div>
                                    <div className="pricing-content">
                                        <ul className="list-unstyled mb-4 pricing-feature-list">
                                            <li><span />دسترسی <span>نامحدود</span> به مدت یک ماه</li>
                                            <li><span>25</span> صفحه زیر را سفارشی کنید</li>
                                            <li><span>150</span> فضای دیسک</li>
                                            <li className="text-deem"><span>5</span> دسترسی به دامنه</li>
                                            <li className="text-deem">پشتیبانی تلفنی 24/7</li>
                                        </ul>
                                        <a href="#" className="btn btn-brand-02 btn-rounded mb-3" target="_blank">هم اکنون بخرید</a>
                                    </div>
                                </div>
                            </div>
                            <div className="col-lg-4 col-md-6 col-sm-8">
                                <div className="text-center bg-white single-pricing-pack mt-4">
                                    <div className="price-img pt-4">
                                        <img src="assets/img/priching-img-3.png" alt="قیمت" width={120} className="img-fluid" />
                                    </div>
                                    <div className="py-4 border-0 pricing-header">
                                        <div className="price text-center mb-0 monthly-price color-secondary" style={{ display: 'block' }}>1,999,000 تومان<span /></div>
                                    </div>
                                    <div className="price-name">
                                        <h5 className="mb-0">یک‌ساله</h5>
                                    </div>
                                    <div className="pricing-content">
                                        <ul className="list-unstyled mb-4 pricing-feature-list">
                                            <li><span />دسترسی <span>محدود</span> به مدت یک ماه</li>
                                            <li><span>15</span> صفحه زیر را سفارشی کنید</li>
                                            <li><span>120</span> فضای دیسک</li>
                                            <li><span>5</span> دسترسی به دامنه</li>
                                            <li>پشتیبانی تلفنی 24/7</li>
                                        </ul>
                                        <a href="#" className="btn btn-outline-brand-02 btn-rounded mb-3" target="_blank">هم اکنون بخرید</a>
                                    </div>
                                </div>
                            </div>
                            <div className="col-12">
                                <div className="support-cta text-center mt-5">
                                    <h5 className="mb-1"><span className="ti-headphone-alt color-primary mr-3" />ما برای راهنمایی به شما اینجا هستیم
            </h5>
                                    <p>سؤال دارید؟ <a href="#contact">اکنون با ما گپ بزنید</a> یا <a href="mailto:hi@hirbod.ac">برای ارتباط با ما ایمیل بفرستید</a> .</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {/*pricing section end*/}
                {/*faq or accordion section */}
                <section id="faq" className="ptb-100 ">
                    <div className="container">
                        <div className="row justify-content-center">
                            <div className="col-md-9 col-lg-8">
                                <div className="section-heading text-center mb-5">
                                    <h2>سوالات متداول</h2>
                                    <p>سوالات عمومی و پرتکرار را برای شما فراهم کرده‌ایم. اگر هم‌چنان پاسخ خود را پیدا نکردید، پذیرای صدای گرم شما هستیم.</p>
                                </div>
                            </div>
                        </div>
                        <div className="row align-items-center">
                            <div className="col-md-12 col-lg-6 mb-5 mb-md-5 mb-sm-5 mb-lg-0">
                                <div className="img-wrap">
                                    <img src="assets/img/hirbod-faqs.png" alt="سوالات متداول هیربد" className="img-fluid" />
                                </div>
                            </div>
                            <div className="col-md-12 col-lg-6">
                                <div id="accordion" className="accordion faq-wrap">
                                    <div className="card mb-3">
                                        <a className="card-header " data-toggle="collapse" href="#collapse0" aria-expanded="false">
                                            <h6 className="mb-0 d-inline-block">آخرین نسخه اپلیکیشن را از کجا دانلود کنم؟</h6>
                                        </a>
                                        <div id="collapse0" className="collapse show" data-parent="#accordion" style={{}}>
                                            <div className="card-body white-bg">
                                                <p>برای دریافت آخرین نسخه اپلیکیشن همواره می‌توانید <strong><a href="https://hirbod.ac/latest.apk" title="دانلود آخرین نسخه اپلیکیشن اندروید">اینجا</a></strong> کلیک کنید. هم‌چنین در صورتی که از گوگل‌پلی، کافه‌بازار و مایکت دریافت‌کرده می‌توانید برای بروزرسانی اقدام کنید.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="card my-3">
                                        <a className="card-header collapsed" data-toggle="collapse" href="#collapse1" aria-expanded="false">
                                            <h6 className="mb-0 d-inline-block">آیا می‌توانم بدون وارد کردن شماره موبایل ثبت‌نام کنم؟</h6>
                                        </a>
                                        <div id="collapse1" className="collapse " data-parent="#accordion" style={{}}>
                                            <div className="card-body white-bg">
                                                <p>بله، هیربد برای راحتی و احترام به حریم‌خصوصی کاربران امکان ثبت‌نام و ورود بدون نیاز به شماره موبایل را برای تمامی کاربران فراهم کرده است.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="card my-3">
                                        <a className="card-header collapsed" data-toggle="collapse" href="#collapse2" aria-expanded="false">
                                            <h6 className="mb-0 d-inline-block">هیربد پلاس چیست؟</h6>
                                        </a>
                                        <div id="collapse2" className="collapse " data-parent="#accordion" style={{}}>
                                            <div className="card-body white-bg">
                                                <p>پلاس، اشتراک ویژه همراهان هیربد است که می‌توانید به هر محتوایی که دلخواهتان باشد دسترسی پیدا کنید. برای آشنایی بیشتر به قسمت پلاس اپلیکیشن مراجعه کنید.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="card mt-3">
                                        <a className="card-header collapsed" data-toggle="collapse" href="#collapse3" aria-expanded="false">
                                            <h6 className="mb-0 d-inline-block">آیا هیربد خدمات سازمانی/شرکتی ارایه می‌کند؟</h6>
                                        </a>
                                        <div id="collapse3" className="collapse " data-parent="#accordion" style={{}}>
                                            <div className="card-body white-bg">
                                                <p>بله، ما در هیربد خدمات ویژه‌ای برای سازمان‌ها، شرکت‌ها، دانشگاه‌ها، موسسات و نهادهای آموزشی ارایه می‌کنیم. جهت کسب اطلاعات بیشتر با ما تماس بگیرید.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {/*faq or accordion section end*/}
                {/*our team section */}
                <section className="team-two-section ptb-100 gray-light-bg">
                    <div className="container">
                        <div className="row justify-content-center">
                            <div className="col-md-9 col-lg-8">
                                <div className="section-heading text-center">
                                    <h2>تیم درجه‌یک هیربد</h2>
                                    <p>ما در هیربد یک تیم درجه‌یک ساخته‌ایم.</p>
                                </div>
                            </div>
                        </div>
                        <div className="row">
                            <div className="col-md-6 col-lg-3">
                                <div className="single-team-wrap bg-white text-center border rounded p-4 mt-4">
                                    <img src="assets/img/team/ali-shabani.png" alt="دکتر علی شعبانی" width={120} className="img-fluid m-auto pb-4" />
                                    <div className="team-content">
                                        <h5 className="mb-0">دکتر علی شعبانی</h5>
                                        <span>مدیرعامل</span>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-6 col-lg-3">
                                <div className="single-team-wrap bg-white text-center border rounded p-4 mt-4">
                                    <img src="assets/img/team/hamed-samet.png" alt="دکتر حامد صامت" width={120} className="img-fluid m-auto pb-4" />
                                    <div className="team-content">
                                        <h5 className="mb-0">دکتر حامد صامت</h5>
                                        <span>مدیر اجرایی</span>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-6 col-lg-3">
                                <div className="single-team-wrap bg-white text-center border rounded p-4 mt-4">
                                    <img src="assets/img/team/naeim-shabani.png" alt="نعیم شعبانی" width={120} className="img-fluid m-auto pb-4" />
                                    <div className="team-content">
                                        <h5 className="mb-0">نعیم شعبانی</h5>
                                        <span>مدیر فروش</span>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-6 col-lg-3">
                                <div className="single-team-wrap bg-white text-center border rounded p-4 mt-4">
                                    <img src="assets/img/team/muhammad-nateghi.png" alt="محمد ناطقی" width={120} className="img-fluid m-auto pb-4" />
                                    <div className="team-content">
                                        <h5 className="mb-0">محمد ناطقی</h5>
                                        <span>مدیر فنی</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {/*our team section end*/}
                {/*our contact section start*/}
                <section id="contact" className="contact-us-section ptb-100">
                    <div className="container">
                        <div className="row justify-content-around">
                            <div className="col-12 pb-3 message-box d-none">
                                <div className="alert alert-danger" />
                            </div>
                            <div className="col-md-12 col-lg-5 mb-5 mb-md-5 mb-sm-5 mb-lg-0">
                                <div className="contact-us-form gray-light-bg rounded p-5">
                                    <h4>برای یک شروع متفاوت آماده هستید؟</h4>
                                    <form action="#" method="POST" id="contactForm" className="contact-us-form">
                                        <div className="form-row">
                                            <div className="col-12">
                                                <div className="form-group">
                                                    <input type="text" className="form-control" name="name" placeholder="نام را وارد کنید" required="required" />
                                                </div>
                                            </div>
                                            <div className="col-12">
                                                <div className="form-group">
                                                    <input type="email" className="form-control" name="email" placeholder="ایمیل را وارد کنید" required="required" />
                                                </div>
                                            </div>
                                            <div className="col-12">
                                                <div className="form-group">
                                                    <textarea name="message" id="message" className="form-control" rows={7} cols={25} placeholder="پیام" defaultValue={""} />
                                                </div>
                                            </div>
                                            <div className="col-sm-12 mt-3">
                                                <button type="submit" className="btn btn-brand-02" id="btnContactUs">
                                                    ارسال پیام
                  </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div className="col-md-12 col-lg-6">
                                <div className="contact-us-content">
                                    <h2>آیا هنوز تردید دارید؟</h2>
                                    <p className="lead">پذیرای حضور گرم شما بصورت حضوری در خانه هیربد هستیم.</p>
                                    <a href="#" className="btn btn-outline-brand-01 align-items-center">دریافت لوکیشن <span className="ti-arrow-left pl-2" /></a>
                                    <hr className="my-5" />
                                    <ul className="contact-info-list">
                                        <li className="d-flex pb-3">
                                            <div className="contact-icon mr-3">
                                                <span className="fas fa-location-arrow color-primary rounded-circle p-3" />
                                            </div>
                                            <div className="contact-text">
                                                <h5 className="mb-1">محل شرکت</h5>
                                                <p>
                                                    تهران - اقدسیه - بلوار ارتش - ساختمان کیمیا
                  </p>
                                            </div>
                                        </li>
                                        <li className="d-flex pb-3">
                                            <div className="contact-icon mr-3">
                                                <span className="fas fa-envelope color-primary rounded-circle p-3" />
                                            </div>
                                            <div className="contact-text">
                                                <h5 className="mb-1">آدرس ایمیل</h5>
                                                <p>
                                                    hi@hirbod.ac
                  </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {/*our contact section end*/}
            </div>

        </MasterPage>
    )
};