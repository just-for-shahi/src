<?php


namespace App\Http\Controllers;

use App\Helpers\ActivityHelper;
use App\Http\Requests\StoreBankTransferRequest;
use App\Models\Account;
use App\Models\BankAccount;
use App\Models\BankPayment;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;


class BankPaymentController extends Controller
{
    private $entity;

    public function __construct()
    {
        $this->entity = new BankPayment();
    }
    public function index(){
        return view('bank-payment.list', [
            'bankPayments' => BankPayment::latest()->paginate(15),
            'accounts' => Account::where('user_id', auth()->id())->get(),
            'bankAccounts' => BankAccount::where(['user_id' => auth()->id(), 'status' => 1])->get()
        ]);
    }

    public function store(StoreBankTransferRequest $r){
        try{
            $bankAccount=$r->input('bank-account');
            $amount=$r->input('amount');
            $usr = auth()->id();
            $this->entity->user = $usr;
            $this->entity->account = Account::where('user_id', $usr)->first()['id'];
            $this->entity->bank_account = $bankAccount;
            $this->entity->amount = $amount;
            $this->entity->receipt = $r->file('receipt')->store(date('Y-m').'/bank-transfers/');
            $this->entity->save();
            ActivityHelper::store($usr, 'پرداخت بانکی شما به مبلغ '.$amount.' از حساب بانکی '.$bankAccount.' ثبت شد.');
            //SMSHelper::sendTemplate('sms', config('azarsarmaye.milad.mobile'), 'BankTransfer', 'milad');
            return redirect()->route('bankPayments.index');
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back()->withInput()->withErrors();
        }
    }



}
