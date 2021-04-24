import React from "react";
import { Link } from "react-router-dom";

const Breadcrumbs = ({ crumbs }) => {

    if (crumbs.length <= 1) {
        return null;
    }

    return (
        // <div className="mb-4 bg-gray-300">
        <ol className="breadcrumb pl-0 mb-0 bg-transparent">

            {crumbs.map(({ name, path }, key) =>
                key + 1 === crumbs.length ? (
                    <span key={key} className="bold breadcrumb-item">
                        {name}
                    </span>
                ) : (
                        <li className="breadcrumb-item">
                            <Link key={key} to={path}>
                                {name}
                            </Link>
                        </li>
                    )
            )}
        </ol>
        // <Link key={key} className="underline text-blue-500 mr-4" to={path}>

        // </div>
    );
};

export default Breadcrumbs;