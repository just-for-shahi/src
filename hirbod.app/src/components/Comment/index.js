import React from "react";
import _ from "lodash";

export default function Comment({ comments }) {
    return (
        <div className="comment">
            <div className="comment-author"><img className="avatar img-fluid rounded-circle" src={`${process.env.PUBLIC_URL}/assets/img/client/3.jpg`} alt="اظهار نظر" /></div>
            <div className="comment-body">
                <div className="comment-meta">
                    <div className="comment-meta-author"><a href="#">{_.get(comments, "user")}</a></div>
                    <div className="comment-meta-date"><a href="#">{_.get(comments, "createdAt")}</a></div>
                </div>
                <div className="comment-content">
                    <p>{_.get(comments, "comment")}</p>
                </div>
                <div className="comment-reply"><a href="#">پاسخ</a></div>
            </div>
            {/* Subcomment*/}
            {_.get(comments, "replies") && _.get(comments, "replies").length > 0 &&
                _.get(comments, "replies").map(r =>
                    <div className="children">
                        <div className="comment">
                            <div className="comment-author"><img className="avatar img-fluid rounded-circle" src={`${process.env.PUBLIC_URL}/assets/img/client/3.jpg`} alt="اظهار نظر" /></div>
                            <div className="comment-body">
                                <div className="comment-meta">
                                    <div className="comment-meta-author"><a href="#">{_.get(r, "user")}</a></div>
                                    <div className="comment-meta-date"><a href="#">{_.get(r, "createdAt")}</a></div>
                                </div>
                                <div className="comment-content">
                                    <p>{_.get(r, "comment")}</p>
                                </div>
                                <div className="comment-reply"><a href="#">پاسخ</a></div>
                            </div>
                        </div>
                    </div>
                )
            }
        </div>
    )
}