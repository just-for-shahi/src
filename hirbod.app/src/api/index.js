import axios from 'axios';
import _ from "lodash";
import { toast } from "react-toastify";

const baseURL = "https://api.hirbod.app/rest/v1";



export const fetchCategories = async () => {
    try {
        const res = await axios.get(`${baseURL}/categories`);
        return _.get(res, "data");
    } catch (error) {
        console.log(error)
        // exTransalte(error);
        // toastErrMsg(error);
    }
};

//===================

export const fetchTags = async () => {
    try {
        const res = await axios.get(`${baseURL}/tags`);
        return _.get(res, "data");
    } catch (error) {
        console.log(error)
        // exTransalte(error);
        // toastErrMsg(error);
    }
};

//===================

export const fetchHome = async () => {
    try {
        const res = await axios.get(`${baseURL}/home`);
        debugger
        return _.get(res, "data");
    } catch (error) {
        console.log(error)
        // exTransalte(error);
        // toastErrMsg(error);
    }
};

//===================

export const fetchCourses = async () => {
    try {
        const res = await axios.get(`${baseURL}/courses`);
        return _.get(res, "data");
    } catch (error) {
        console.log(error)
        // exTransalte(error);
        // toastErrMsg(error);
    }
};

//====================

export const fetchCourseDetail = async (id) => {
    try {
        console.log('uri', `${baseURL}/courses/${id}/show`)
        const res = await axios.get(`${baseURL}/courses/${id}/show`);
        return _.get(res, "data");
    } catch (error) {
        console.log(error)
        // exTransalte(error);
        // toastErrMsg(error);
    }
};

//===================

export const fetchPodcasts = async () => {
    try {
        const res = await axios.get(`${baseURL}/podcasts`);
        debugger
        return _.get(res, "data");
    } catch (error) {
        console.log(error)
        // exTransalte(error);
        // toastErrMsg(error);
    }
};

//====================

export const fetchPodcastDetail = async (id) => {
    try {
        debugger
        console.log('uri', `${baseURL}/podcasts/${id}/show`)
        const res = await axios.get(`${baseURL}/podcasts/${id}/show`);
        return _.get(res, "data.data");
    } catch (error) {
        console.log(error)
        // exTransalte(error);
        // toastErrMsg(error);
    }
};

//===================

export const fetchBooks = async () => {
    try {
        const res = await axios.get(`${baseURL}/ebooks`);
        return _.get(res, "data");
    } catch (error) {
        console.log(error)
        // exTransalte(error);
        // toastErrMsg(error);
    }
};

//====================

export const fetchBookDetail = async (id) => {
    try {
        console.log('uri', `${baseURL}/ebooks/${id}/show`)
        const res = await axios.get(`${baseURL}/ebooks/${id}/show`);
        return _.get(res, "data");
    } catch (error) {
        console.log(error)
        // exTransalte(error);
        // toastErrMsg(error);
    }
};

//===================

export const fetchEvents = async () => {
    try {
        const res = await axios.get(`${baseURL}/events`);
        return _.get(res, "data");
    } catch (error) {
        console.log(error)
        // exTransalte(error);
        // toastErrMsg(error);
    }
};

//====================

export const fetchEventDetail = async (id) => {
    try {
        console.log('uri', `${baseURL}/events/${id}/show`)
        const res = await axios.get(`${baseURL}/events/${id}/show`);
        return _.get(res, "data");
    } catch (error) {
        console.log(error)
        // exTransalte(error);
        // toastErrMsg(error);
    }
};