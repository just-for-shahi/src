import React from "react";
import { Form, Input } from "antd";


export const InputItem = ({ name, label, labelCol, labelAlign, rules, ltr, onChange, maxLength, placeholder, tabIndex = 0 }) => (
    <Form.Item name={name} label={label} rules={rules} labelCol={labelCol} labelAlign={labelAlign}>
        <Input
            style={{ borderRadius: '8px', height: '3rem' }}
            onChange={onChange}
            ltr={ltr}
            maxLength={maxLength}
            placeholder={placeholder}
            tabIndex={tabIndex}
        />
    </Form.Item>
);