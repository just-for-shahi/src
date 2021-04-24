<?php


namespace App\Enums\UAccount;


abstract class Broker
{
    const OANDA = 0;
    const ALPARI = 1;
    const FXTM = 2;
    const ROBOFOREX = 3;
    const HOTFOREX = 4;
    const FXCM = 5;
    const ALPARI_INTL = 6;
    const ICMARKETS = 7;


    const OANDA_HTML = 'Oanda';
    const ALPARI_HTML = 'Alpari';
    const FXTM_HTML = 'ForexTime';
    const ROBOFOREX_HTML = 'RoboForex';
    const HOTFOREX_HTML = 'HotForex';
    const FXCM_HTML = 'FXCM';
    const ALPARI_INTL_HTML = 'Alpari International';
    const ICMARKETS_HTML = 'ICMarkets';
}
