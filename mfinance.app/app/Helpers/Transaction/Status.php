<?php


namespace App\Helpers\Transaction;


abstract class Status
{
    public static function status($s){
        try{
            switch (intval($s)){
                default:
                case \App\Enums\Transaction\Status::WAITING_PAYMENT:
                    return \App\Enums\Transaction\Status::WAITING_PAYMENT_HTML;
                    break;
                case \App\Enums\Transaction\Status::PAID:
                    return \App\Enums\Transaction\Status::PAID_HTML;
                    break;
                case \App\Enums\Transaction\Status::IN_PROCESS:
                    return \App\Enums\Transaction\Status::IN_PROCESS_HTML;
                    break;
                case \App\Enums\Transaction\Status::CANCELED:
                    return \App\Enums\Transaction\Status::CANCELED_HTML;
                    break;
                case \App\Enums\Transaction\Status::BLOCKED:
                    return \App\Enums\Transaction\Status::BLOCKED_HTML;
                    break;
            }
        }catch (\Exception $e){
            return null;
        }
    }
}
