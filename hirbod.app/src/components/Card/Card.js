import React, { useState, useEffect } from "react";
import _ from "lodash";
import { Link } from 'react-router-dom';

export default function Card({ data, onClick }) {
    // const [ route, setRoute ] = useState('');

    // useEffect(() => {
    //     getDetails();
    // }, [route]);

    // const getDetails = () =>{
    //     _.get(_.find(typeIcon, function(obj){
    //         if(obj.type === data.type) {
    //             setIcon(obj.icon);
    //             setRoute(obj.route);
    //         }
    //     }))
    // }

    //author: "vahiidrah"
    // categories: (2) [{…}, {…}]
    // description: "test test"
    // duration: "123"
    // introduction: "test"
    // lectures: []
    // level: 1
    // photo: "https://s.hirbod.ac/hirbod/2021-01/course/HuvUuVhHrHxc5geXqZjZ2hGFTnPrKXAI5pQsPKky.jpg"
    // price: 1000
    // rate: 4.2
    // status: 1
    // students: 1
    // tags: (2) [{…}, {…}]
    // title: "course title"
    // uuid: "a9a968a6-2f77-473c-9c54-f3468038df8f"
    return (
        <div className="col-md-6 col-lg-4" onClick={() => onClick(data)}>
            <div className="single-blog-card card gray-light-bg border-0 shadow-sm my-3">
                <div className="blog-img position-relative">
                    <img
                        src={_.get(data, "photo") || "assets/img/blog/2.jpg"}
                        className="card-img-top" alt={data.title} />
                    <div className="meta-date">
                        <strong> </strong>
                        <small></small>
                    </div>
                </div>
                <div className="card-body">
                    <p className="card-text">{data.author}</p>
                    <h3 className="h5 mb-2 card-title"><a href="#">{data.title}</a></h3>
                    <p className="card-text">{data.description}</p>
                    <div className="post-meta mb-2">

                        <ul className="list-inline meta-list">
                            <li className="list-inline-item"><i className="fas fa-users mr-2" /><span>{data.students}</span> دانش آموز  </li>

                            <li className="list-inline-item"><i className=" mr-2" />
                                <span className="btn btn-brand-02 btn-rounded mb-2" >{`${data.price} تومان`}</span>
                            </li>
                        </ul>
                    </div>
                    {/* <Link to={`${route}/${data.uuid}`} className="detail-link"> */}
                        بیشتر بخوانید <span className="ti-arrow-left" />
                    {/* </Link> */}
                </div>
            </div>
        </div>
    )
}