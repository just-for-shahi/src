<?php


namespace App\Helpers\Ticket;


class Department
{
    public static function department($d){
        try{
            switch (intval($d)){
                default:
                case \App\Enums\Ticket\Department::GENERAL:
                    return \App\Enums\Ticket\Department::GENERAL_HTML;
                    break;
                case \App\Enums\Ticket\Department::FINANCE:
                    return \App\Enums\Ticket\Department::FINANCE_HTML;
                    break;
                case \App\Enums\Ticket\Department::INVESTMENT:
                    return \App\Enums\Ticket\Department::INVESTMENT_HTML;
                    break;
                case \App\Enums\Ticket\Department::UACCOUNTS:
                    return \App\Enums\Ticket\Department::UACCOUNTS_HTML;
                    break;
                case \App\Enums\Ticket\Department::HODHOD:
                    return \App\Enums\Ticket\Department::HODHOD_HTML;
                    break;
                case \App\Enums\Ticket\Department::SESSIONS:
                    return \App\Enums\Ticket\Department::SESSIONS_HTML;
                    break;
                case \App\Enums\Ticket\Department::CORPORATIONS:
                    return \App\Enums\Ticket\Department::CORPORATIONS_HTML;
                    break;
                case \App\Enums\Ticket\Department::ADMINS:
                    return \App\Enums\Ticket\Department::ADMINS_HTML;
                    break;
            }
        }catch (\Exception $e){
            return \App\Enums\Ticket\Department::GENERAL_HTML;
        }
    }

}
