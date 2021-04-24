import React,{ Fragment } from 'react';
import WalletCharge from './views/walletCharge';
import { ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import './App.css';
import "antd/dist/antd.css";


function App() {
  return (
    <Fragment>
      <ToastContainer />
      <WalletCharge />
    </Fragment>
  );
}

export default App;
