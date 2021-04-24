import React from 'react';
import "./spinner.css";


const pleaseWaitMsg = "لطفا منتظر بمانید";

export function Spinner() {

    return (
        <div className="spinnerStyles">
            <div className="msg">
                {pleaseWaitMsg}
            </div>
            <div className="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    );
};