<?php


namespace App\Http\Controllers\Milad;


use App\Helpers\SMSHelper;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\BankAccount;
use App\Models\Investment;
use App\Models\User;
use App\Models\Withdraw;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    private $entity;

    public function __construct()
    {
        $this->entity = new Withdraw();
    }

    public function index()
    {
        return view('admin.withdraw.list', ['withdraws' => Withdraw::with('user')->latest()->paginate(15)]);
    }

    public function create()
    {
        $accounts = Account::where('user_id', auth()->id())->get();
        $bankAccounts = BankAccount::where('user_id', auth()->id())->get();
        return view('admin.withdraw.create', ['accounts' => $accounts, 'bank_accounts' => $bankAccounts]);
    }

    public function store(Request $request)
    {
        $accountID = $request->input('account');
        $bankAccountID = $request->input('bank_account');
        $amount = (int)$request->input('amount');
        $account = Account::where(['user_id' => auth()->id(), 'id' => $accountID, 'status' => 0])->first();
        $bankAccount = BankAccount::where(['user_id' => auth()->id(), 'id' => $bankAccountID, 'status' => 1])->first();
        if ($account == null) {
            return back()->withInput()->with(['message' => 'حساب مالی فعال نیست.']);
        }
        if ($bankAccount == null) {
            return back()->withInput()->with(['message' => 'حساب بانکی فعال نیست.']);
        }
        if ($amount > $account->balance) {
            return back()->withInput()->with(['message' => 'موجودی حساب مالی شما کمتر از مبلغ درخواستی است.']);
        }
        $this->entity->user = auth()->id();
//        $this->entity->bank_account = $bankAccountID;
        $this->entity->account = $accountID;
        $this->entity->amount = $amount;
        $this->entity->save();
        $investments = Investment::where(['user_id' => auth()->id(), 'account' => $accountID])->get();
        foreach ($investments as $investment) {
            Investment::where('id', $investment->id)->update([
                'withdraw_at' => Carbon::now(),
                'status' => 3
            ]);
        }
        Account::where('id', $accountID)->decrement('balance', $amount);
        return redirect()->route('withdraws.index');
    }

    public function destroy($withdraw)
    {
        $withdraw = Withdraw::where(['id' => $withdraw, 'user_id' => auth()->id(), 'status' => 0])->first();
        if ($withdraw == null) {
            return back()->with(['error' => 'خطایی در اجرای درخواست شما بوجود آمده است.']);
        }
        $investments = Investment::where(['user_id' => auth()->id(), 'account' => $withdraw->account])->get();
        foreach ($investments as $investment) {
            Investment::where('id', $investment->id)->update([
                'withdraw_at' => null,
                'status' => 1
            ]);
        }
        Account::where('id', $withdraw->account)->increment('balance', $withdraw->amount);
        Withdraw::where('id', $withdraw->id)->update(['status' => 4]);
        return redirect()->route('withdraws.index');
    }

    public function accept(Withdraw $withdraw, Request $request)
    {
        $inquiry = $request->input('inquiry');
        $usr = User::where('id', $withdraw->user_id)->first();
        try {
            \DB::beginTransaction();
            Account::where('id', $withdraw->account)->decrement('balance', $withdraw->amount);
            Withdraw::where('id', $withdraw->id)->update(['status' => 2, 'inquiry' => $inquiry]);
            \DB::commit();
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }

//        SMSHelper::sendTemplate2Tokens('sms', $usr->mobile, $withdraw->id, $withdraw->amount, 'uinvest-withdraw');

        flash('success');
        return back();
    }

}
