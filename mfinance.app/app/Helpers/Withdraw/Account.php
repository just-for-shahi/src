<?php


namespace App\Helpers\Withdraw;


use App\Helpers\Wallet\Currency;
use App\Http\Controllers\BankAccount\BankAccount;
use App\Http\Controllers\Wallet\Wallet;

class Account
{

    public static function account($ba, $sa){
        try{
            $ac=null;
            if ($ba===null){
                $bankAcc = BankAccount::find($ba);
                $ac=$bankAcc['no'].' - '.$bankAcc['card'];
            }
            if ($sa===null){
                $serviceAcc = Wallet::find($sa);
                $ac=Currency::service($serviceAcc['service']).' - '.$serviceAcc['no'];
            }
            return $ac;
        }catch (\Exception $e){
            return null;
        }
    }

}
