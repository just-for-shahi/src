<?php


namespace App\Helpers\BankAccount;


class Currency
{
    public static function currency($c){
        try{
            switch (intval($c)){
                default:
                case \App\Enums\BankAccount\Currency::USD:
                    return 'USD';
                    break;
                case \App\Enums\BankAccount\Currency::EUR:
                    return 'EURO';
                    break;
                case \App\Enums\BankAccount\Currency::AED:
                    return 'Dirham';
                    break;
                case \App\Enums\BankAccount\Currency::IRR:
                    return 'Iranian Rial';
                    break;
            }
        }catch (\Exception $e){
            return abort(500);
        }
    }
}
