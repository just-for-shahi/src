import React,{ Fragment } from 'react';
import Routes from "./routes";
import _ from "lodash";

import { ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import './App.css';
import "antd/dist/antd.css";


function App() {
  return (
    <Fragment>
      <ToastContainer />
      <Routes/>

    </Fragment>
  );
}

export default App;
