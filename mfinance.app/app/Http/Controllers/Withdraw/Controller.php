<?php


namespace App\Http\Controllers\Withdraw;


use App\Enums\Withdraw\Status;
use App\Http\Controllers\BankAccount\BankAccount;
use App\Http\Controllers\Investment\Investment;
use App\Http\Controllers\Wallet\Wallet;
use App\Http\Requests\WithdrawStoreRequest;
use App\Scripts\Helpers\ValidationHelper;
use Illuminate\Http\Request;

class Controller extends \App\Http\Controllers\Controller
{
    public function index()
    {
        $items = Withdraw::me()->with(['investment', 'wallet'])->latest()->get();
        return view('withdraws.index', compact('items'));
    }

    public function new()
    {
//        $bank_accounts = BankAccount::me()->latest()->get();
        $service_accounts = Wallet::me()->active()->latest()->get();
        $investments = Investment::me()->latest()->get();

        return view('withdraws.new',
            compact('service_accounts', 'investments')
        );
    }

    public function store(WithdrawStoreRequest $r)
    {
        $r->store();

        flash();
        return redirect()->route('withdraws.index');
    }

    public function cancel(Withdraw $withdraw)
    {
        abort_if(!$withdraw->is_cancellable, 403);

        $withdraw->update([
            'status' => Status::CANCELLED_BY_USER
        ]);

        flash('success');
        return back();
    }

    public function updateStatus(Withdraw $withdraw, Request $request)
    {
        authorizeAdminsOnly();
        $request->validate([
            'status' => ValidationHelper::inArray(\App\Helpers\Withdraw\Status::all())
        ]);

        $withdraw->update([
            'status' => $request->status
        ]);

        flash();
        return back();
    }

}
