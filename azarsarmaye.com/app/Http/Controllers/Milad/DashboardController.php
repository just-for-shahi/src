<?php


namespace App\Http\Controllers\Milad;


use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Investment;
use App\Models\Ticket;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index(){
        $accounts = Account::latest()->get();
        $accountsNum = Account::all()->count();
        $balance = Account::all()->sum('balance');
        $transactions = Transaction::latest()->get();
        $transactionsNum = Transaction::all()->sum('amount');
        $investments = Investment::latest()->get();
        $tickets = Ticket::latest()->get();
        return view('dashboard', [
            'accounts' => $accounts,
            'accounts_num' => $accountsNum,
            'balance' => $balance,
            'transactions' => $transactions,
            'transactions_num' => $transactionsNum,
            'investments' => $investments,
            'tickets' => $tickets
        ]);
    }
}
