import React, { useRef, useState } from "react";
import { useHistory } from "react-router-dom";
import { Row, Col, Form, Button } from "antd";
import { get } from "lodash";
import ReCAPTCHA from "react-google-recaptcha";
import { toast } from "react-toastify";
import { InputItem } from "../components/InputItem/InputItem";
import { HirbodLogo } from "../components/Icons/Logo";
import { Spinner } from "../components/Spinner/Spinner";

import "./walletCharge.css";
import { postWalletCharge } from './../api/index';
import { SubmitBtn } from "../components/Button/SubmitBtn";

window.recaptchaOptions = {
    useRecaptchaNet: true,
};

export default function WalletCharge(props) {
    const [ form ] = Form.useForm();
    const recaptchaRef = useRef();
    const history = useHistory();
    const [ loading, setLoading ] = useState(false);


    const verifyCallback = (response) => {
        console.log(response)
    }

    const numberCommaSplitter = (num) => {
        return Number(Math.floor(num).toFixed(0)).toLocaleString().split(/\s/).join(',');
    }

    const onSubmit = async (values) => {

        setLoading(true);
        const result = await postWalletCharge(values);
        if (result) {
            window.location.href = get(result, "data.url");
        } else {
            setLoading(false);
            toast.error('خطا در ورود مقادیر');
        }
    };

    const onSubmitFailed = () => { };

    // if (loading) return <Spinner />;

    return (
        <div className="walletCountainer">
            <div className="card">
                <header className="card-header">
                    <HirbodLogo />
                </header>
                <div>

                </div>
                <Row>
                    <Form
                        name="charge"
                        layout="vertical"
                        form={form}
                        onSubmit={onSubmit}
                        onFinish={onSubmit}
                        onFinishFailed={onSubmitFailed}
                        labelCol={{ span: 24 }}
                        className="form"
                        method="post"
                    >
                        <Col span={24}>
                            <div className="title divider">
                                <span>
                                    شارژ مستقیم حساب هیربد
                            </span>
                            </div>
                        </Col>
                        <Col span={24}>
                            <div className="items" >

                                <span className="label">شماره تماس جهت شارژ حساب</span>
                                <InputItem
                                    name="mobile"
                                    // rules={phoneNumberRules}
                                    placeholder="مثلا 09123456789"
                                    tabIndex={1}
                                />

                                <span className="label">مبلغ به ریال</span>
                                <InputItem
                                    name="amount"
                                    // rules={phoneNumberRules}
                                    placeholder="مثلا 100,000"
                                    tabIndex={1}
                                />
                            </div>
                        </Col>
                        <Col span={24}>
                            <div className="capcha">
                                <Form.Item name="token">
                                    <ReCAPTCHA
                                        className="recapcha"
                                        ref={recaptchaRef}
                                        size="normal"
                                        sitekey="6LfT-SgaAAAAABGGhGWzDaa3E3WlCZQSonuVdume"
                                        hl="fa"
                                        verifyCallback={verifyCallback}
                                    />
                                </Form.Item>
                            </div>
                        </Col>
                        <Col span={24}>
                            <div className="items" >
                                {loading && <Spinner/>}
                                {!loading && <SubmitBtn >پرداخت</SubmitBtn>}
                            </div >

                        </Col>

                    </Form>
                </Row>
            </div>
        </div>
    );
}

