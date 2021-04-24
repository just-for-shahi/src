<?php


namespace App\Helpers\UAccount;


abstract class Broker
{
    public static function Broker($b){
        try{
            switch (intval($b)){
                default:
                case \App\Enums\UAccount\Broker::OANDA:
                    return \App\Enums\UAccount\Broker::OANDA_HTML;
                    break;
                case \App\Enums\UAccount\Broker::ALPARI:
                    return \App\Enums\UAccount\Broker::ALPARI_HTML;
                    break;
                case \App\Enums\UAccount\Broker::FXTM:
                    return \App\Enums\UAccount\Broker::FXTM_HTML;
                    break;
                case \App\Enums\UAccount\Broker::ROBOFOREX:
                    return \App\Enums\UAccount\Broker::ROBOFOREX_HTML;
                    break;
                case \App\Enums\UAccount\Broker::HOTFOREX:
                    return \App\Enums\UAccount\Broker::HOTFOREX;
                    break;
                case \App\Enums\UAccount\Broker::FXCM:
                    return \App\Enums\UAccount\Broker::FXCM_HTML;
                    break;
                case \App\Enums\UAccount\Broker::ALPARI_INTL:
                    return \App\Enums\UAccount\Broker::ALPARI_INTL_HTML;
                    break;
                case \App\Enums\UAccount\Broker::ICMARKETS:
                    return \App\Enums\UAccount\Broker::ICMARKETS_HTML;
                    break;
            }
        }catch (\Exception $e){

        }
    }
}
