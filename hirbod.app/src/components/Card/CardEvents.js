import React, { useState, useEffect } from "react";
import _ from "lodash";
import { Link } from 'react-router-dom';
import "./card.css";
import { StudentsIcon } from "../Icons";

export default function CardEvents({ data, onClick, category }) {

    const price = _.get(data, "price") > 0 ? `${_.get(data, "price")} تومان` : 'رایگان';

    return (
        <div className="col-md-6 col-lg-4" onClick={() => onClick(data)}>
            <div className="single-blog-card card gray-light-bg border-0 shadow-sm my-3">
                <div className="blog-img position-relative image">
                    <img
                        src={_.get(data, "photo") || "assets/img/blog/2.jpg"}
                        className="card-img-top img-responsive" alt={data.title} />

                </div>
                <div className="card-body">
                    <div className="row mb-2">
                        <div className="avatar">:)</div>
                        <p className="card-text">{data.author}</p>

                    </div>
                    <p className="card-text mb-2">{category}</p>
                    <h3 className="h5 mb-2 card-title"><a >{data.title}</a></h3>
                    <div className="post-meta mb-2 ml-2">

                        <div className="row meta-list">
                            <div className="col row mt-2">
                                <div className="mr-2">
                                    <StudentsIcon />
                                </div>
                                <div >
                                    <span>{data.students}</span>  شرکت کننده
                                 </div>
                            </div>
                            <div className="col row"></div>
                            <div className="col row">
                                <span className="btn  btn-rounded mb-2 btn-price" >{price}</span>
                            </div>
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