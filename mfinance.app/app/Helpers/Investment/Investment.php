<?php


namespace App\Helpers\Investment;


use App\Helpers\BankAccount\Currency;

class Investment
{
    public static function summary(\App\Http\Controllers\Investment\Investment $investment)
    {
//        return $investment['amount'] . ' - ' . Type::type($investment['type']);
        return $investment->amount . ' ' . $investment->cryptocurrency_string; //TODO: Update after investment is complete.
    }
}
