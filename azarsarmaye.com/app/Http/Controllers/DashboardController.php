<?php


namespace App\Http\Controllers;


use App\Helpers\InvestmentHelper;
use App\Models\Account;
use App\Models\Investment;
use App\Models\Ticket;
use App\Models\Transaction;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class DashboardController extends Controller
{
    public function index(){
        try{

            $usr = auth()->id();
            $accounts = Account::where('user_id', $usr)->latest()->take(3)->get();
            $accountsNum = Account::where('user_id', $usr)->count();
            $balance = Account::where('user_id', $usr)->sum('balance');
            $transactions = Transaction::where('user_id', $usr)->latest()->take(3)->get();
            $transactionsNum = Transaction::where(['user_id' => $usr, 'status' => 1])->sum('amount');
            $investments = Investment::where('user_id', $usr)->latest()->take(3)->get();
            $tickets = Ticket::where('user_id', $usr)->latest()->take(3)->get();
            return view('dashboard', [
                'accounts' => $accounts,
                'accounts_num' => $accountsNum,
                'balance' => $balance,
                'transactions' => $transactions,
                'transactions_num' => $transactionsNum,
                'investments' => $investments,
                'tickets' => $tickets
            ]);
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return abort(500);
        }
    }

    public function profit(){
        return InvestmentHelper::dailyProfit();
    }
}
