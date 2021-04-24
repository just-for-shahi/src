import React, { Fragment } from 'react';




function Footer () {
    return (
        <Fragment>
             <div>
  <footer className="footer-1 gradient-bg ptb-60 footer-with-newsletter">
    {/*subscribe newsletter start*/}
    {/* <div className="container">
      <div className="row newsletter-wrap primary-bg rounded shadow-lg p-5">
        <div className="col-md-6 col-lg-7 mb-4 mb-md-0 mb-sm-4 mb-lg-0">
          <div className="newsletter-content text-white">
            <h3 className="mb-0 text-white">زودتر باخبر شوید!</h3>
            <p className="mb-0">خبرهای داغ هیربد را با عضویت در خبرنامه ایمیلی ما دریافت کنید.</p>
          </div>
        </div>
        <div className="col-md-6 col-lg-5">
          <form className="newsletter-form position-relative">
            <input type="text" className="input-newsletter form-control" placeholder="ایمیل خود را وارد کنید" name="email" required autoComplete="off" />
            <button type="submit" className="disabled"><i className="fas fa-paper-plane" /></button>
          </form>
        </div>
      </div>
    </div> */}
    {/*subscribe newsletter end*/}
    <div className="container">
      <div className="row">
        <div className="col-md-12 col-lg-4 mb-4 mb-md-4 mb-sm-4 mb-lg-0">
          <a href="#" className="navbar-brand mb-2">
            <img src={`${process.env.PUBLIC_URL}/assets/img/logo-white.png`} alt="هیربد" className="img-fluid" />
          </a>
          <br />
          <p>هیربد، اولین پلتفرم تخصصی آموزشی کشور با تکیه بر دانش تخصصی جوانان دانشگاه شریف و تجربه اساتید برتر کشور طراحی، تولید و ارایه شده است. ما در هیربد بدنبال ارتقای اکوسیستم آموزشی کشور هستیم.</p>
          <div className="list-inline social-list-default background-color social-hover-2 mt-2">
            <li className="list-inline-item"><a className="twitter" href="#"><i className="fab fa-twitter" /></a></li>
            <li className="list-inline-item"><a className="youtube" href="#"><i className="fab fa-youtube" /></a></li>
            <li className="list-inline-item"><a className="linkedin" href="#"><i className="fab fa-linkedin-in" /></a></li>
            <li className="list-inline-item"><a className="dribbble" href="#"><i className="fab fa-dribbble" /></a></li>
          </div>
        </div>
        <div className="col-md-12 col-lg-8">
          <div className="row mt-0">
            <div className="col-sm-6 col-md-3 col-lg-3 mb-4 mb-sm-4 mb-md-0 mb-lg-0">
              <h6 className="text-uppercase">منابع</h6>
              <ul>
                <li>
                  <a href="#">مرکز راهنمایی</a>
                </li>
                <li>
                  <a href="#">مرکز طراحی</a>
                </li>
                <li>
                  <a href="#">جلسات زنده</a>
                </li>
                <li>
                  <a href="#">ویترین</a>
                </li>
                <li>
                  <a href="https://api.hirbod.ac/docs/">API Document</a>
                </li>
              </ul>
            </div>
            <div className="col-sm-6 col-md-3 col-lg-3 mb-4 mb-sm-4 mb-md-0 mb-lg-0">
              <h6 className="text-uppercase">محصولات</h6>
              <ul>
                <li>
                  <a href="#">دوره‌های آموزشی</a>
                </li>
                <li>
                  <a href="#">پادکست‌ها</a>
                </li>
                <li>
                  <a href="#">کتاب‌ها</a>
                </li>
                <li>
                  <a href="#">رویدادها</a>
                </li>
                <li>
                  <a href="#">دیده‌شو</a>
                </li>
              </ul>
            </div>
            <div className="col-sm-6 col-md-3 col-lg-3 mb-4 mb-sm-4 mb-md-0 mb-lg-0">
              <h6 className="text-uppercase">شرکت</h6>
              <ul>
                <li>
                  <a href="#about">درباره ما</a>
                </li>
                <li>
                  <a href="#">تیم ما</a>
                </li>
                <li>
                  <a href="#">مشتریان</a>
                </li>
                <li>
                  <a href="#">انجمن</a>
                </li>
                <li>
                  <a href="#contact">تماس با ما</a>
                </li>
              </ul>
            </div>
            <div className="col-sm-6 col-md-3 col-lg-3">
              <h6 className="text-uppercase">دیگر سرویس‌ها</h6>
              <ul>
                <li>
                  <a href="https://azarsarmaye.com">آذرسرمایه</a>
                </li>
                <li>
                  <a href="https://aznasoft.com">آزناسافت</a>
                </li>
                <li>
                  <a href="#">روانزی<small>(روانشناسی و مشاوره آنلاین)</small></a>
                </li>
                <li>
                  <a href="https://azna.cloud">آزناکلود</a>
                </li>
                <li>
                  <a href="#">آذرپرداخت</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    {/*end of container*/}
  </footer>
  {/*footer bottom copyright start*/}
  <div className="footer-bottom py-3 gray-light-bg">
    <div className="container">
      <div className="row">
        <div className="col-md-6 col-lg-7">
          <div className="copyright-wrap small-text">
            <p className="mb-0">© کلیه حقوق برای «پلتفرم آموزشی هیربد» محفوظ است. ۹۹-۱۳۹۷</p>
          </div>
        </div>
        <div className="col-md-6 col-lg-5">
          <div className="terms-policy-wrap text-lg-right text-md-right text-left">
            <ul className="list-inline">
              <li className="list-inline-item"><a className="small-text" href="#">قوانین استفاده</a></li>
              <li className="list-inline-item"><a className="small-text" href="#">سیاست حریم خصوصی</a></li>
              <li className="list-inline-item"><a className="small-text" href="#">DMCA</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <div className="scroll-top scroll-to-target primary-bg text-white" data-target="html">
    <span className="fas fa-hand-point-up" />
  </div>
</div>
      
          
        </Fragment>
    )
}


export default Footer