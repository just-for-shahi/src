import React, { useState, useEffect, useContext } from "react";
import { useHistory } from 'react-router-dom';
import _ from "lodash";
import { CategoryContext } from '../../context';

import Card from "../../components/Card/Card";
import { Spinner } from "../../components/Spinner/Spinner";
import MasterPage from "../../Layouts/Master/Master";
import { fetchHome, fetchBooks } from "../../api";
import { BOOKS, BOOK_DETAIL } from "../../common/commonUrls";
import CardBooks from "../../components/Card/CardBooks";
import { PAGE_SIZE } from "../../Enum";
import Pagination from "../../components/Pagination";
import { paginate } from './../../utils/index';
import Breadcrumbs from "../../components/BreadCrump";

export default function BooksPage({ crumbs }) {

    const { books, setBooks, page, setPage, } = useContext(CategoryContext);
    const [ data, setData ] = useState([]);
    const [ itemsCount, setItemsCount ] = useState(0);
    const [ currentPage, setCurrentPage ] = useState(1);
    const [ loading, setLoading ] = useState(false);

    const selectedData = paginate(data, currentPage, PAGE_SIZE);

    const history = useHistory();


    const handleFetchData = async () => {
        setLoading(true);
        const res = await fetchBooks();
        if (res) {
            setData(_.get(res, "data"));
            setItemsCount((_.get(res, "data").length));
            setBooks(_.get(res, "data"));
        }
        setLoading(false);
    }


    useEffect(() => {

        handleFetchData();

    }, []);

    const handleClickDetail = (data) => {
        console.log('detail', data);
        history.push(`${BOOKS}/${_.get(data, "uuid")}`)
    }

    const handlePageChange = page => {
        setCurrentPage(page);
    }



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
                                    <h1 className="text-white mb-0">کتاب</h1>
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

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <section className="our-blog-section ptb-100">
                    <div className="container">
                        <div className="row">
                            {loading && <Spinner />}

                            {!loading &&
                                selectedData.map(d =>
                                    <CardBooks
                                        data={d}
                                        key={_.get(d, "uuid")}
                                        category="کتاب"
                                        onClick={handleClickDetail} />
                                )
                            }

                        </div>
                        {/*pagination start*/}
                        <div className="row">
                            <div className="col-md-12">
                                <Pagination
                                    itemsCount={itemsCount}
                                    pageSize={PAGE_SIZE}
                                    currentPage={currentPage}
                                    onPageChage={handlePageChange}
                                />
                            </div>
                        </div>
                        {/*pagination end*/}
                    </div>
                </section>
                {/*blog section end*/}
            </div>

        </MasterPage>
    )
};