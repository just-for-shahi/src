<?php


namespace App\Helpers\BankAccount;


class BankAccount
{

    public static function summary($ba){
        try{
            $bankAcc = \App\Http\Controllers\BankAccount\BankAccount::find($ba);
            return $bankAcc['no'].' - '.$bankAcc['card'];
        }catch (\Exception $e){
            return null;
        }
    }

}
