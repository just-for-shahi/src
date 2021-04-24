import React from "react";
import _ from "lodash";
import { Link } from 'react-router-dom';
import "./card.css";
import { StarIcon } from './../Icons/index';

export default function CardBooks({ data, onClick, category }) {

    const price = _.get(data, "price") > 0 ? `${_.get(data, "price")} تومان` : 'رایگان';

    return (
        <div className="col-md-6 col-lg-4" onClick={() => onClick(data)}>
            <div className="single-blog-card card gray-light-bg border-0 shadow-sm my-3">
                <div className="blog-img position-relative image2">
                    <img
                        src={_.get(data, "photo") || "assets/img/blog/2.jpg"}
                        className="card-img-top" alt={data.title} />

                </div>
                <div className="card-body">

                    <div className="row mt-2 mr-1">
                        <div className="col row  mb-2 ml-1">
                            <p className="card-text">{category}</p>
                        </div>
                        <div className="col row float-left"></div>
                            <span className="rate mr-2" >{data.rate}</span>
                            <StarIcon />
                    </div>

                    <h3 className="h5 mb-2 card-title"><a >{data.title}</a></h3>

                    <div className="row mb-2 ml-1 meta-list">
                        {`انتشارات: ${data.introduction}`}
                    </div>
                    <div className="post-meta mb-2 ml-2">

                        <div className="row meta-list">

                            <span className="btn  btn-rounded mb-2 btn-price-nobgr" >{price}</span>

                        </div>

                    </div>
                    <Link to="" className="detail-link">
                        بیشتر بخوانید <span className="ti-arrow-left" />
                    </Link>
                </div>
            </div>
        </div>
    )
}