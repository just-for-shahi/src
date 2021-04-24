<?php


namespace App\Http\Controllers;


use App\Enums\SMSTemplate;
use App\Enums\SMSType;
use App\Helpers\ActivityHelper;
use App\Helpers\PaymentHelper;
use App\Helpers\SMSHelper;
use App\Http\Requests\StoreInvestmentRequest;
use App\Jobs\SendSMS;
use App\Models\Account;
use App\Models\Investment;
use App\Models\Transaction;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Carbon\Carbon;

class InvestmentController extends Controller
{

    private $entity;

    public function __construct()
    {
        $this->entity = new Investment();
    }

    public function index()
    {
        try {
            $accounts = Account::me()->latest()->get();
            $investments = Investment::me()->latest()->paginate(15);
            return view('investment.list', compact('investments', 'accounts'));
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
            return back()->withInput()->withErrors();
        }
    }

    public function store(StoreInvestmentRequest $request)
    {
        $account = $request->input('account');
        $amount = intval($request->input('amount'));
        $acc = Account::where('id', $account)->first();
        $pay = false;
        if ($acc['harvestable'] >= $amount) {
            Account::where('id', $account)->decrement('harvestable', $amount);
            $pay = true;
        }
        $this->entity->user_id = auth()->id();
        $this->entity->account = $account;
        $this->entity->amount = $amount;
        $this->entity->invested_at = $pay === true ? Carbon::now() : null;
        $this->entity->withdraw_at = null;
        $this->entity->status = $pay === true ? 1 : 0;
        $this->entity->save();
        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'from' => $pay === true ? $account : 0,
            'to' => $account,
            'amount' => $amount,
            'description' => 'سرمایه گذاری شماره ' . $this->entity->id,
            'authority' => intval('00' . random_int(10000, 99999)),
            'status' => $pay === true ? 1 : 0,
            'gateway' => 0,
        ]);
        Investment::where('id', $this->entity->id)->update(['transaction' => $transaction->id]);
        ActivityHelper::store(auth()->id(), 'سرمایه‌گذاری جدید به مبلغ ' . $amount);
        //SendSMS::dispatch(SMSType::MILAD, config('mana.milad.mobile'), 'سرمایه گذاری جدید', SMSTemplate::MILAD);
        if ($pay) {
            return redirect()->route('investments.index');
        } else {
            return redirect()->route('investments.index');
//                $paymentHelper = new PaymentHelper();
//                return redirect($paymentHelper->pay($transaction->id));
        }
    }

}
