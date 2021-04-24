<?php


namespace App\Helpers\UAccount;


abstract class Status
{
    public static function status($s){
        try{
            switch (intval($s)){
                default:
                case \App\Enums\UAccount\Status::IN_PROGRESS:
                    return \App\Enums\UAccount\Status::IN_PROGRESS_HTML;
                    break;
                case \App\Enums\UAccount\Status::ACTIVE:
                    return \App\Enums\UAccount\Status::ACTIVE_HTML;
                    break;
                case \App\Enums\UAccount\Status::DEACTIVE:
                    return \App\Enums\UAccount\Status::DEACTIVE_HTML;
                    break;
                case \App\Enums\UAccount\Status::SUSPENDED:
                    return \App\Enums\UAccount\Status::SUSPENDED_HTML;
                    break;
            }
        }catch (\Exception $e){
            return abort(500);
        }
    }
}
