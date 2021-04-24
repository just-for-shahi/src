import React from "react";
import _ from "lodash";
import { PAGE_SIZE } from "../../Enum";

const Pagination = ({ itemsCount, pageSize = PAGE_SIZE, currentPage, onPageChage }) => {

    const pagesCount = Math.ceil(itemsCount / pageSize);

    if (pagesCount === 1) return null;

    const pages = _.range(1, pagesCount + 1);

    return (
        <nav className="custom-pagination-nav mt-4">
            <ul className="pagination justify-content-center">
                <li className="page-item">
                    <a className="page-link" onClick={() => onPageChage(currentPage - 1)}><span className="ti-angle-right" /></a>
                </li>

                {pages.map(page =>
                    <li className={page === currentPage ? "page-item active" : "page-item"} key={page}>
                        <a className="page-link" onClick={() => onPageChage(page)}>{page}</a>
                    </li>
                )}

                <li className="page-item">
                    <a className="page-link" onClick={() => onPageChage(currentPage + 1)}><span className="ti-angle-left" /></a>
                </li>
            </ul>
        </nav>
    );
}

export default Pagination;


