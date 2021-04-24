import React, { Fragment } from 'react';
import { Link } from 'react-router-dom';
import {ABOUT, CONTACT, HOME,  PLUS} from "../../common/commonUrls";


function Header() {
   
    return (
        <Fragment>
            <header className="header">
                {/*start navbar*/}
                <nav className="navbar navbar-expand-lg fixed-top bg-transparent">
                    <div className="container">
                        <a className="navbar-brand" href="index.html">
                            <img src={`${process.env.PUBLIC_URL}/assets/img/logo-white.png`} alt="هیربد" className="img-fluid" />
                        </a>
                        <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="ناوبری را تغییر دهید">
                            <span className="ti-menu" />
                        </button>
                        <div className="collapse navbar-collapse h-auto" id="navbarSupportedContent">
                            <ul className="navbar-nav ml-auto menu">
                                <li><Link to={HOME}>صفحه‌نخست</Link></li>
                                <li><Link to={ABOUT} className="page-scroll">درباره ما</Link></li>
                                <li><a href="#features" className="page-scroll">امکانات</a></li>
                                <li><a href="#process" className="page-scroll">برنامه همکاری</a></li>
                                <li><Link to={PLUS} className="page-scroll">هیربد پلاس</Link></li>
                                <li><Link to={CONTACT} className="page-scroll">تماس با ما</Link></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>

        </Fragment>
    )
}

export default Header