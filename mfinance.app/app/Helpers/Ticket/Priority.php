<?php


namespace App\Helpers\Ticket;


class Priority
{
    public static function priority($p){
        try{
            switch (intval($p)){
                default:
                case \App\Enums\Ticket\Priority::NORMAL:
                    return \App\Enums\Ticket\Priority::NORMAL_HTML;
                    break;
                case \App\Enums\Ticket\Priority::NON_SIGNIFICANT:
                    return \App\Enums\Ticket\Priority::NON_SIGNIFICANT_HTML;
                    break;
                case \App\Enums\Ticket\Priority::IMPORTANT:
                    return \App\Enums\Ticket\Priority::IMPORTANT_HTML;
                    break;
            }
        }catch (\Exception $e){
            return \App\Enums\Ticket\Priority::NORMAL;
        }
    }

}
