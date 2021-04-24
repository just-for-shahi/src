import axios from 'axios';
import _ from "lodash";
import { toast } from "react-toastify";

const baseURL = "https://hirbod.liara.run/rest/v1";


export const postWalletCharge = async (data) => {
    try {
        const res = await axios.post(`${baseURL}/finance/charge/phone`, data);
        return _.get(res, "data");
    } catch (error) {
        console.log('err', error);
        // toast.error(_.get(error,'خطایی اتفاق افتاد'))
        return null;
    }
};
