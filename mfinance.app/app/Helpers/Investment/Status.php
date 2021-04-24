<?php


namespace App\Helpers\Investment;


class Status
{
    public static function status($s){
        try{
            switch (intval($s)){
                default:
                case \App\Enums\Investment\Status::WAITING_PAYMENT:
                    return \App\Enums\Investment\Status::WAITING_PAYMENT_HTML;
                    break;
                case \App\Enums\Investment\Status::ACTIVE:
                    return \App\Enums\Investment\Status::ACTIVE_HTML;
                    break;
                case \App\Enums\Investment\Status::FINISHED:
                    return \App\Enums\Investment\Status::FINISHED_HTML;
                    break;
                case \App\Enums\Investment\Status::CANCELED:
                    return \App\Enums\Investment\Status::CANCELED_HTML;
                    break;
                case \App\Enums\Investment\Status::BLOCKED:
                    return \App\Enums\Investment\Status::BLOCKED_HTML;
                    break;
            }
        }catch (\Exception $e){
            return abort(500);
        }
    }

}
