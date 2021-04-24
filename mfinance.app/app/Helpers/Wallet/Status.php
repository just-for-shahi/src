<?php


namespace App\Helpers\Wallet;


use App\Scripts\Abstracts\EnumMapper;

class Status
{
    use EnumMapper;

    public static function map()
    {
        return [
            \App\Enums\Wallet\Status::REGISTERED => 'Waiting Approve',
            \App\Enums\Wallet\Status::ACTIVE => 'Active',
            \App\Enums\Wallet\Status::REJECTED => 'Rejected',
            \App\Enums\Wallet\Status::BLOCKED => 'Blocked',
            \App\Enums\Wallet\Status::ARCHIVED => 'Archived',
        ];
    }

    public static function status($key)
    {
        return self::valueOf($key);
//        try {
//            switch ((int)$s) {
//                case \App\Enums\Wallet\Status::REGISTERED:
//                    return \App\Enums\Wallet\Status::REGISTERED_HTML;
//                case \App\Enums\Wallet\Status::ACTIVE:
//                    return \App\Enums\Wallet\Status::ACTIVE_HTML;
//                case \App\Enums\Wallet\Status::REJECTED:
//                    return \App\Enums\Wallet\Status::REJECTED_HTML;
//                case \App\Enums\Wallet\Status::BLOCKED:
//                    return \App\Enums\Wallet\Status::BLOCKED_HTML;
//                case \App\Enums\Wallet\Status::ARCHIVED:
//                    return \App\Enums\Wallet\Status::ARCHIVED_HTML;
//            }
//        } catch (\Exception $e) {
//            return abort(500);
//        }
    }

}
