<?php


namespace App\Http\Controllers;


use App\Enums\SMSTemplate;
use App\Enums\SMSType;
use App\Helpers\ActivityHelper;
use App\Helpers\PaymentHelper;
use App\Jobs\SendSMS;
use App\Models\Account;
use App\Models\Investment;
use App\Models\Transaction;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    private $entity;

    public function __construct()
    {
        $this->entity = new Transaction();
    }

    public function index(){
        try{
            $transactions = Transaction::me()->latest()->paginate(15);
            return view('transaction.list', compact('transactions'));
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back()->withInput()->withErrors();
        }
    }

    public function show($uuid){
        try{
            $transaction = Transaction::where(['uuid' => $uuid, 'user_id' => auth()->id()])->first();
            if ($transaction === null){
                return redirect()->route('transactions.index');
            }
            return view('transaction.show', ['transaction' => $transaction]);
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back()->withInput()->withErrors();
        }
    }

    public function payment($uuid){
        try{
            $transaction = Transaction::findUUID($uuid);
            $payment = new PaymentHelper();
            return redirect($payment->pay($transaction->id));
        }catch (\Exception $e){
            return dd($e);
        }
    }

    public function callback(Request $r){
        try{
            $authority = $r->input('Authority');
            $status = $r->input('Status');
            if ($status == "OK"){
                $payment = new PaymentHelper();
                if ($payment->verify($authority)){
                    $transaction = Transaction::where('authority', $authority)->first();
                    $usr = auth()->user();
                    if ($usr->captain != null){
                        $acc = Account::where('user_id', $usr->captain)->first();
                        $investments = Investment::where(['user_id' => $usr->id, 'status' => 1])->first();
                        if ($investments === null){
                            Account::where('id', $acc->id)->increment('balance', $transaction->amount*0.03);
                            ActivityHelper::store($usr->captain, 'هدیه همکاری شما به مبلغ '.$transaction->amount.' به حساب مالی '.$acc->id.' واریز شد.');
                        }
                    }
                    Investment::where('transaction', $transaction->id)->update(['invested_at' => now(), 'status' => 1]);
                    Account::where('id', $transaction->to)->increment('balance', $transaction->amount);
                    SendSMS::dispatch(SMSType::TEMPLATE, auth()->user()->mobile, $authority, SMSTemplate::PAYMENT);
                    SendSMS::dispatch(SMSType::MILAD, config('mana.milad.mobile'), 'ثبت پرداخت', SMSTemplate::MILAD);
                    ActivityHelper::store(auth()->id(), 'پرداخت شماره '.$transaction->authority.' با موفقیت انجام شد.');
                    ActivityHelper::store(auth()->id(), 'سرمایه‌گذاری شما با موفقیت آغاز شد. هر شب بین ساعات 3 تا 5 بامداد سود طرح انتخابی به حساب مالی واریز خواهد شد.');
                }
            }
            return redirect()->route('transactions.index');
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }


}
