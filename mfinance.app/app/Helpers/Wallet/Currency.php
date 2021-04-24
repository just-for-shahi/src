<?php


namespace App\Helpers\Wallet;


class Currency
{
    public static function currency($c){
        try{
            switch (intval($c)){
                default:
                case \App\Enums\Wallet\Currency::USDT:
                    return 'Tether(USDT)';
                    break;
                case \App\Enums\Wallet\Currency::BNB:
                    return 'Binance (BNB)';
                    break;
                case \App\Enums\Wallet\Currency::TUSD:
                    return 'True USD (TUSD)';
                    break;
                case \App\Enums\Wallet\Currency::PAX:
                    return 'PAX';
                    break;
            }
        }catch (\Exception $e){
            return abort(500);
        }
    }
}
