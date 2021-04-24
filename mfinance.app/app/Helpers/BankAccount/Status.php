<?php


namespace App\Helpers\BankAccount;


class Status
{
    public static function status($s){
        try{
            switch (intval($s)){
                default:
                case \App\Enums\BankAccount\Status::REGISTERED:
                    return \App\Enums\BankAccount\Status::REGISTERED_HTML;
                    break;
                case \App\Enums\BankAccount\Status::VERIFIED:
                    return \App\Enums\BankAccount\Status::VERIFIED_HTML;
                    break;
                case \App\Enums\BankAccount\Status::LEGAL:
                    return \App\Enums\BankAccount\Status::LEGAL_HTML;
                    break;
                case \App\Enums\BankAccount\Status::BLOCKED:
                    return \App\Enums\BankAccount\Status::BLOCKED_HTML;
                    break;
            }
        }catch (\Exception $e){
            return abort(500);
        }
    }
}
