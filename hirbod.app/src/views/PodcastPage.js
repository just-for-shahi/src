import React, { useState, useEffect, useContext } from "react";
import _ from "lodash";
import { CategoryContext } from '../context';

import Card from "../components/Card/Card";
import MasterPage from "../Layouts/Master/Master";
import { fetchHome } from "../api";

export default function PodcastPage() {

    const { categories, setCategories } = useContext(CategoryContext);

    const [ data, setData ] = useState([]);

    const handleFetchData = async () => {
        const res = await fetchHome();
        if (res) setData(_.get(res, "data[5].items"));
    }


    useEffect(() => {
        if (categories.length > 0) {
            setData(_.get(categories, "data[5].items"));
        } else {
            handleFetchData();
        }
    }, []);

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
                                    <h1 className="text-white mb-0">پادکست</h1>
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
                                        <li className="breadcrumb-item active">پادکست</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <section className="our-blog-section ptb-100">
                    <div className="container">
                        <div className="row">

                            {data.map(d => <Card data={d} />)}

                        </div>
                        {/*pagination start*/}
                        {/* <div className="row">
                            <div className="col-md-12">
                                <nav className="custom-pagination-nav mt-4">
                                    <ul className="pagination justify-content-center">
                                        <li className="page-item"><a className="page-link" href="#"><span className="ti-angle-right" /></a></li>
                                        <li className="page-item active"><a className="page-link" href="#">1</a></li>
                                        <li className="page-item"><a className="page-link" href="#">2</a></li>
                                        <li className="page-item"><a className="page-link" href="#">3</a></li>
                                        <li className="page-item"><a className="page-link" href="#">4</a></li>
                                        <li className="page-item"><a className="page-link" href="#"><span className="ti-angle-left" /></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div> */}
                        {/*pagination end*/}
                    </div>
                </section>
                {/*blog section end*/}
            </div>

        </MasterPage>
    )
};