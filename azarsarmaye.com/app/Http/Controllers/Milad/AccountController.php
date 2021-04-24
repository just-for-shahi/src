<?php


namespace App\Http\Controllers\Milad;


use App\Helpers\SMSHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountRequest;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\Wallet;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    private $entity;

    public function __construct()
    {
        $this->entity = new Account();
    }

    public function index()
    {
        return view('admin.account.list', [
            'accounts' => Account::with(["investments", 'user', 'user.wallets'])->latest()->paginate(12),
        ]);
    }

    public function create()
    {
        return view('admin.account.create');
    }

    public function store(StoreAccountRequest $request)
    {
        $this->entity->user = $request->input('user_id');
//        $this->entity->type = $request->input('type');
//        $this->entity->plan = $request->input('plan');
        $this->entity->balance = 0;
        $this->entity->status = 0;
        $this->entity->save();
        return redirect()->route('accounts.index');
    }

    public function edit($account)
    {
        $account = Account::where('id', $account)->first();
        return view('accounts.edit', ['account' => $account]);
    }

    public function update($account, Request $request)
    {
        try {
            $data = [];
            if ($request->has('type')) {
                $data['type'] = $request->input('type');
            }
            if ($request->has('plan')) {
                $data['plan'] = $request->input('plan');
            }
            if ($request->has('balance')) {
                $data['balance'] = $request->input('balance');
            }
            if ($request->has('status')) {
                $data['status'] = $request->input('status');
            }
            Account::where('id', $account)->update($data);
            return redirect()->route('admin.mbank-accounts');
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
            return back();
        }
    }

    public function destroy(Account $account)
    {
        $accounts = Account::me()->get();
        if (count($accounts) === 1) {
            flash('message', 'کاربر باید حداقل یک حساب داشته باشد.');
            return back();
        }

        if ($account->balance != 0) {
            flash('message', 'موجودی حساب جهت انحلال باید صفر باشد.');
            return back();
        }

        $account->delete();

        return back();
    }

    public function accept($account)
    {
        try {
            Account::where('id', $account)->update(['status' => 0]);
            return redirect()->route('admin.maccounts.index');
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
            return back();
        }
    }

    public function charge(Account $account, Request $request)
    {
        $amount = $request->input('amount');
        if ((int)$amount < 100) {
            return back();
        }

        Transaction::create([
            'user_id' => auth()->id(),
            'from' => $request->input('wallet'),
            'to' => $account->id,
            'amount' => $amount,
            'description' => 'افزایش موجودی حساب مالی  ' . $account['no'],
            'authority' => (int)('00' . random_int(10000, 99999)),
            'status' => 0,
            'gateway' => 0,
        ]);

        $account->balance += $amount;
        $account->update();

        flash('success');
        return back();
    }
}
