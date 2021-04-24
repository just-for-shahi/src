import React, { useState, useEffect, useContext } from "react";
import { useHistory, useParams } from "react-router-dom";

import _ from "lodash";
import { CategoryContext } from '../../context';

import { Spinner } from "../../components/Spinner/Spinner";
import MasterPage from "../../Layouts/Master/Master";
import { fetchEventDetail, fetchCategories, fetchTags, fetchEvents } from "../../api";
import { StudentsIcon, ClockIcon } from "../../components/Icons";
import { CAT_EVENTS } from "../../Enum";
import Comment from "../../components/Comment";
import Breadcrumbs from "../../components/BreadCrump";

export default function EventDetailPage({ crumbs }) {

    const { categories, setCategories, tags, setTags, events, setEvents } = useContext(CategoryContext);

    const id = useParams();

    const [ data, setData ] = useState([]);
    const [ loading, setLoading ] = useState(false);
    const [ subLoading, setSubLoading ] = useState(false);

    const handleFetchData = async () => {
        setLoading(true);
        const res = await fetchEventDetail(Object.values(id));
        if (res) setData(_.get(res, "data"));
        setLoading(false);

        console.log('eve-det', res)
    }

    const handleFetchCategories = async () => {
        setSubLoading(true);
        const res = await fetchCategories();
        if (res) {
            const result = _.get(res, "data").filter(r => r.type === CAT_EVENTS);
            setCategories(result);
        }
        setSubLoading(false);

    }

    const handleFetchTags = async () => {
        setSubLoading(true);
        const res = await fetchTags();
        if (res) setTags(res);
        setSubLoading(false);
    }

    const handleFetchEvents = async () => {
        setSubLoading(true);
        const res = await fetchEvents();
        if (res) {
            setEvents(_.get(res, "data"));
        }
        setSubLoading(false);
    }

    useEffect(() => {

        handleFetchData();
        if (categories.length < 1) handleFetchCategories();
        if (tags.length < 1) handleFetchTags();
        if (events.length < 1) handleFetchEvents();

    }, []);



    return (
        <MasterPage>
            <div className="main">
                {/*page header section start*/}
                <section className="page-header-section ptb-100 bg-image" image-overlay={8}>
                    <div className="background-image-wraper" style={{ background: `url(${process.env.PUBLIC_URL}/assets/img/slider-bg-1.jpg)`, opacity: 1 }} />
                    <div className="container">
                        <div className="row align-items-center">
                            <div className="col-md-9 col-lg-7">
                                <div className="page-header-content text-white pt-4">
                                    <h1 className="text-white mb-0">رویداد آموزشی</h1>
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
                                    <Breadcrumbs crumbs={crumbs} />
                                    {/* <ol className="breadcrumb pl-0 mb-0 bg-transparent">
                                        <li className="breadcrumb-item"><a href="#">خانه</a></li>
                                        <li className="breadcrumb-item"><a href="#">صفحات</a></li>
                                        <li className="breadcrumb-item active">بیشتر</li>
                                    </ol> */}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {/*breadcrumb section end*/}
                {loading && <Spinner />}

                {/*blog section start*/}

                {!loading &&

                    <div className="module ptb-100">
                        <div className="container">
                            <div className="row">
                                <div className="col-lg-8 col-md-8">
                                    {/* Post*/}
                                    <article className="post">
                                        <div className="post-preview"><img src={_.get(data, "photo")} alt="رویداد" className="img-fluid image" /></div>
                                        <div className="post-wrapper">
                                            <div className="post-header">
                                                <h1 className="post-title">{_.get(data, "title")}</h1>
                                                <p className="post-text">{_.get(data, "author")}</p>
                                                <ul className="post-meta">
                                                    <li>{_.get(data, "createdAt") && _.get(data, "createdAt").substr(0, 10)}</li>
                                                    {/* <li>در <a href="#">برندسازی</a> ، <a href="#">طراحی</a></li> */}
                                                    <li><a href="#">{_.get(data, "comments") && _.get(data, "comments").length || 0}</a> نظر</li>
                                                </ul>

                                                <div className="row meta-list">
                                                    <div className="col row mt-2">
                                                        <div className="mr-2">
                                                            <StudentsIcon />
                                                        </div>
                                                        <div >
                                                            <span>{_.get(data, "students")}</span>  شرکت کننده
                                                    </div>
                                                    </div>
                                                    <div className="col row">
                                                        <ClockIcon />
                                                        <span className="btn  btn-rounded mb-2 " >{_.get(data, "duration")}</span> مدت زمان دوره
                                                </div>
                                                </div>
                                                <ul className="post-meta">
                                                    <li>{`دسته بندی : ${_.get(data, "categories[0].title", "")} `}</li>
                                                </ul>
                                            </div>
                                            <div className="post-content">
                                                <p>{_.get(data, "description")}</p>
                                            </div>
                                            <div className="post-footer">

                                                <div className="post-tags">
                                                    {(_.get(data, "tags")) && (_.get(data, "tags")).map(tag => <a key={tag.uuid}>{tag.title} </a>)}
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    {/* Post end*/}
                                    {/* Comments area*/}
                                    <div className="comments-area mb-5">
                                        <h5 className="comments-title">{_.get(data, "comments") && _.get(data, "comments").length || 0}  نظر</h5>
                                        <div className="comment-list">
                                            {/* Comment*/}
                                            {_.get(data, "comments") && _.get(data, "comments").map(c => <Comment comments={c} key={_.get(c, "uuid")} />)}
                                            {/* Comment*/}

                                        </div>
                                        <div className="comment-respond">
                                            <h5 className="comment-reply-title">پاسخ دهید</h5>
                                            <p className="comment-notes">آدرس ایمیل شما منتشر نخواهد شد. قسمت های مورد نیاز علامت گذاری شده اند</p>
                                            <form className="comment-form row">
                                                <div className="form-group col-md-4">
                                                    <input className="form-control" type="text" placeholder="نام" />
                                                </div>
                                                <div className="form-group col-md-4">
                                                    <input className="form-control" type="text" placeholder="پست الکترونیک" />
                                                </div>
                                                <div className="form-group col-md-4">
                                                    <input className="form-control" type="url" placeholder="سایت اینترنتی" />
                                                </div>
                                                <div className="form-group col-md-12">
                                                    <textarea className="form-control" rows={8} placeholder="اظهار نظر" defaultValue={""} />
                                                </div>
                                                <div className="form-submit col-md-12">
                                                    <button className="btn btn-brand-02" type="submit">ارسال نظر</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    {/* Comments area end*/}
                                </div>
                                <div className="col-lg-4 col-md-4">
                                    <div className="sidebar-right pl-4">
                                        {/* Search widget*/}
                                        {/* <aside className="widget widget-search">
                                            <form>
                                                <input className="form-control" type="search" placeholder="کلمات جستجو را تایپ کنید" />
                                                <button className="search-button" type="submit"><span className="ti-search" /></button>
                                            </form>
                                        </aside> */}
                                        {/* Categories widget*/}
                                        <aside className="widget widget-categories">
                                            <div className="widget-title">
                                                <h6>دسته بندی ها</h6>
                                            </div>
                                            {subLoading && <Spinner />}

                                            <ul>
                                                {categories && !subLoading &&
                                                    categories.map(category => <li key={category.uuid}><a href="#">{category.title} </a></li>)
                                                }
                                                {/* <li><a href="#">سفر <span className="float-right">112</span></a></li> */}

                                            </ul>
                                        </aside>
                                        {/* Recent entries widget*/}
                                        <aside className="widget widget-recent-entries-custom">
                                            <div className="widget-title">
                                                <h6>رویداد های مشابه</h6>
                                            </div>
                                            {subLoading && <Spinner />}

                                            <ul>
                                                {events && !subLoading &&
                                                    events.map(c =>
                                                        <li className="clearfix">
                                                            <div className="wi"><a href="#"><img src={`${process.env.PUBLIC_URL}/assets/img/blog/2.jpg`} alt="رویداد اخیر" className="img-fluid rounded" /></a></div>
                                                            <div className="wb"><a href="#">{_.get(c, "title")} </a>
                                                                <span className="post-date">{_.get(c, "author")}</span>
                                                                <span className="post-date">{`${_.get(c, "price")} تومان`}</span>
                                                            </div>
                                                        </li>

                                                    )
                                                }

                                            </ul>
                                        </aside>
                                        {/* Subscribe widget*/}
                                        {/* <aside className="widget widget-categories">
                                            <div className="widget-title">
                                                <h6>خبرنامه</h6>
                                            </div>
                                            <p>آدرس ایمیل خود را در زیر وارد کنید تا در خبرنامه من عضو شوید</p>
                                            <form action="#" method="post" className="d-none d-md-block d-lg-block">
                                                <input type="text" className="form-control input" id="email-footer" name="email" placeholder="info@yourdomain.com" />
                                                <button type="submit" className="btn btn-brand-02 btn-block btn-not-rounded mt-3">عضویت</button>
                                            </form>
                                        </aside> */}
                                        {/* Tags widget*/}
                                        <aside className="widget widget-tag-cloud">
                                            <div className="widget-title">
                                                <h6>برچسب ها</h6>
                                            </div>
                                            {subLoading && <Spinner />}

                                            {tags && !subLoading &&
                                                <div className="tag-cloud">
                                                    {tags.map(tag => <a key={tag.uuid}>{tag.title}</a>)}
                                                </div>
                                            }
                                        </aside>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                }
                {/*blog section end*/}
            </div>


        </MasterPage>
    )
};