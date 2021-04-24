<?php


namespace App\Helpers\Withdraw;


use App\Scripts\Abstracts\EnumMapper;

class Status
{
    use EnumMapper;

    public static function map(): array
    {
        return [
            \App\Enums\Withdraw\Status::REGISTERED => 'Registered',
            \App\Enums\Withdraw\Status::IN_PROGRESS => 'In Progress',
            \App\Enums\Withdraw\Status::PAYMENT => 'Payment',
            \App\Enums\Withdraw\Status::DONE => 'Done',
            \App\Enums\Withdraw\Status::REJECTED => 'Rejected',
            \App\Enums\Withdraw\Status::BLOCKED => 'Blocked',
            \App\Enums\Withdraw\Status::CANCELLED_BY_USER => 'Cancelled',
        ];
    }

    public static function status($s)
    {
        try {
            switch (intval($s)) {
                default:
                case \App\Enums\Withdraw\Status::REGISTERED:
                    return \App\Enums\Withdraw\Status::REGISTERED_HTML;
                case \App\Enums\Withdraw\Status::IN_PROGRESS:
                    return \App\Enums\Withdraw\Status::IN_PROGRESS_HTML;
                case \App\Enums\Withdraw\Status::PAYMENT:
                    return \App\Enums\Withdraw\Status::PAYMENT_HTML;
                case \App\Enums\Withdraw\Status::DONE:
                    return \App\Enums\Withdraw\Status::DONE_HTML;
                case \App\Enums\Withdraw\Status::REJECTED:
                    return \App\Enums\Withdraw\Status::REJECTED_HTML;
                case \App\Enums\Withdraw\Status::BLOCKED:
                    return \App\Enums\Withdraw\Status::BLOCKED_HTML;
                case \App\Enums\Withdraw\Status::CANCELLED_BY_USER:
                    return \App\Enums\Withdraw\Status::CANCELLED_BY_USER_HTML;
            }
        } catch (\Exception $e) {
            return \App\Enums\Withdraw\Status::REGISTERED_HTML;
        }
    }
}
