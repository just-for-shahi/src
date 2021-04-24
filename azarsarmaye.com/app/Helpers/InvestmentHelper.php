<?php


namespace App\Helpers;


use App\Models\Account;
use App\Models\Investment;
use App\Models\User;
use Carbon\Carbon;

class InvestmentHelper
{

    public static function dailyProfit(){
        try{
//            $now = Carbon::now();
//            $investments = Investment::where([
//                ['status', '=', 1],
//                ['withdraw_at', '=', null],
//                ['invested_at', '!=', null]
//            ])->get();
//            foreach ($investments as $investment){
//                if ($investment['profited_at'] === null){
//                    self::handleDailyProfit($investment);
//                }else{
//                    $diff = $now->diffInHours(Carbon::parse($investment['profited_at']));
//                    if ($diff>20){
//                        self::handleDailyProfit($investment);
//                    }
//                }
//            }
            return dd(true);
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public static function handleDailyProfit($investment){
        $account = Account::find($investment['account']);
        $percent = $account['plan'] === 0 ? config('uinvest.sarina_daily_profit') : config('uinvest.mahina_daily_profit');
        $profit = $investment['amount'] * $percent;
        Account::where('id', $investment['account'])->increment('balance', $profit);
        ActivityHelper::store($investment['user_id'], 'واریز '.$profit.' تومان سود روزانه سرمایه‌گذاری شماره '.$investment['id'].' واریز شد.');
        $usr = User::where('id', $investment['user_id'])->first();
        SMSHelper::sendTemplate2Tokens('sms', $usr->mobile, $account['no'], $profit, 'uinvest-profit');
        Investment::where('id', $investment['id'])->update(['profited_at' => Carbon::now()]);
    }

    public static function summary($investment){
        $investment = Investment::find($investment);
        return '#'.$investment['id'].' /مبلغ: '.$investment['amount'].' تومان';
    }

}
