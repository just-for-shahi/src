<?php


namespace App\Helpers\Transaction;


abstract class Type
{
    public static function type($t){
        try{
            switch (intval($t)){
                case \App\Enums\Transaction\Type::INVESTMENT:
                    return \App\Enums\Transaction\Type::INVESTMENT_HTML;
                    break;
                case \App\Enums\Transaction\Type::DEPOSIT:
                    return \App\Enums\Transaction\Type::DEPOSIT_HTML;
                    break;
                case \App\Enums\Transaction\Type::WITHDRAW:
                    return \App\Enums\Transaction\Type::WITHDRAW_HTML;
                    break;
                case \App\Enums\Transaction\Type::TRANSFER:
                    return \App\Enums\Transaction\Type::TRANSFER_HTML;
                    break;
                default:
                case \App\Enums\Transaction\Type::SYSTEM:
                    return \App\Enums\Transaction\Type::SYSTEM_HTML;
                    break;
                case \App\Enums\Transaction\Type::PROFIT:
                    return \App\Enums\Transaction\Type::PROFIT_HTML;
                    break;
            }
        }catch (\Exception $e){
            return \App\Enums\Transaction\Type::SYSTEM_HTML;
        }
    }
}
