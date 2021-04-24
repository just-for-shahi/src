import React from 'react';
import { Form, Button } from "antd";
import "./submitBtn.css";


export const SubmitBtn = ({ children }) => (
    <Form.Item>
        {/* <div className="btn-wraper"> */}
            <button type="submit"  className="btn">
                {children}
            </button>
        {/* </div> */}
    </Form.Item>

);