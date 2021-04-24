<?php


namespace App\Helpers\CallRequest;


class Status
{

    public static function status($s)
    {
        switch ((int)$s) {
            default:
            case \App\Enums\CallRequest\Status::REGISTERED:
                return \App\Enums\CallRequest\Status::REGISTERED_HTML;
                break;
            case \App\Enums\CallRequest\Status::SPEAKED:
                return \App\Enums\CallRequest\Status::SPEAKED_HTML;
                break;
            case \App\Enums\CallRequest\Status::NO_ANSWER:
                return \App\Enums\CallRequest\Status::NO_ANSWER_HTML;
                break;
            case \App\Enums\CallRequest\Status::CANCELED:
                return \App\Enums\CallRequest\Status::CANCELED_HTML;
                break;
        }

    }

}
