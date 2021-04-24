<?php


namespace App\Http\Controllers;


use App\Enums\SMSTemplate;
use App\Enums\SMSType;
use App\Helpers\ActivityHelper;
use App\Http\Requests\StoreWithdrawRequest;
use App\Jobs\SendSMS;
use App\Models\Account;
use App\Models\BankAccount;
use App\Models\Investment;
use App\Models\Withdraw;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class WithdrawController extends Controller
{

    private $entity;

    public function __construct()
    {
        $this->entity = new Withdraw();
    }

    public function index(){
        try{
            $bankAccounts = BankAccount::where('user_id', auth()->id())->get();
            $accounts = Account::where('user_id', auth()->id())->get();
            $withdraws = Withdraw::me()->latest()->paginate(15);
            return view('withdraw.list', compact('bankAccounts', 'accounts', 'withdraws'));
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back()->withInput()->withErrors();
        }
    }

    public function store(StoreWithdrawRequest $request){
        try{
            $accountID = $request->input('account');
            $bankAccountID = $request->input('bank-account');
            $amount = intval($request->input('amount'));
            $account = Account::where(['user_id' => auth()->id(), 'id' => $accountID, 'status' => 0])->first();
            $bankAccount = BankAccount::where(['user_id' => auth()->id(), 'id' => $bankAccountID, 'status' => 1])->first();
            if ($account == null){
                return back()->withInput()->withErrors(['error' => 'حساب مالی فعال نیست.']);
            }
            if ($bankAccount == null){
                return back()->withInput()->withErrors(['error' => 'حساب بانکی فعال نیست.']);
            }
            if ($amount > $account->balance){
                return back()->withInput()->withErrors(['error' => 'موجودی حساب مالی شما کمتر از مبلغ درخواستی است.']);
            }
            $investments = Investment::where(['user_id' => auth()->id(), 'account' => $accountID, 'status' => 1])->get();
            $investmentsAmount = 0;
            foreach ($investments as $investment){
                $investment = Investment::where('id', $investment->id)->first();
                $investmentsAmount += $investment->amount;
            }
            if($account->balance-$amount < $investmentsAmount){
                return back()->withInput()->withErrors(['error' => 'مبلغ برداشت شما از مبلغ سرمایه‌گذاری شما بیشتر است. جهت تسویه به بخش حساب مالی مراجعه کنید.']);
            }
            $this->entity->user = auth()->id();
            $this->entity->bank_account = $bankAccountID;
            $this->entity->account = $accountID;
            $this->entity->amount = $amount;
            $this->entity->save();
            ActivityHelper::store(auth()->id(), 'برداشت شما با موفقیت به صف پرداختی اضافه شد. پس از پرداخت دوباره اطلاع خواهیم داد.');
            SendSMS::dispatch(SMSType::MILAD, config('mana.milad.mobile'), 'ثبت برداشت', SMSTemplate::MILAD);
            return redirect()->route('withdraws.index');
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back();
        }
    }

    public function destroy($uuid){
        try{
            $withdraw = Withdraw::where(['uuid' => $uuid, 'user_id' => auth()->id(), 'status' => 0])->first();
            if ($withdraw == null){
                return back()->with(['error' => 'خطایی در اجرای درخواست شما بوجود آمده است.']);
            }
            $investments = Investment::where(['user_id' => auth()->id(), 'account' => $withdraw->account])->get();
            foreach ($investments as $investment){
                Investment::where('id', $investment->id)->update([
                    'withdraw_at' => null,
                    'status' => 1
                ]);
            }
            Account::where('id', $withdraw->account)->increment('balance', $withdraw->amount);
            Withdraw::where('id', $withdraw->id)->update(['status' => 4]);
            return redirect()->route('withdraws.index');
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back()->withInput()->withErrors();
        }
    }
}
