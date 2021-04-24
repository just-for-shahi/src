<?php


namespace App\Helpers\Ticket;


class Status
{

    public static function status($status){
        switch (intval($status)){
            default:
            case \App\Enums\Ticket\Status::WAITING:
                return \App\Enums\Ticket\Status::WAITING_HTML;
                break;
            case \App\Enums\Ticket\Status::IN_PROGRESS:
                return \App\Enums\Ticket\Status::IN_PROGRESS_HTML;
                break;
            case \App\Enums\Ticket\Status::REPLIED:
                return \App\Enums\Ticket\Status::REPLIED_HTML;
                break;
            case \App\Enums\Ticket\Status::SOLVED:
                return \App\Enums\Ticket\Status::SOLVED_HTML;
                break;
        }
    }

}
