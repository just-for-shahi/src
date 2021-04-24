<?php


namespace App\Http\Controllers;


use App\Enums\SMSTemplate;
use App\Enums\SMSType;
use App\Helpers\ActivityHelper;
use App\Http\Requests\StoreBankAccountRequest;
use App\Jobs\SendSMS;
use App\Models\BankAccount;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class BankAccountController extends Controller
{
    private $entity;

    public function __construct()
    {
        $this->entity = new BankAccount();
    }

    public function index(){
        try{
            return view('bank-account.list', ['bank_accounts' => BankAccount::where('user_id', auth()->id())->latest()->paginate(15)]);
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back()->withInput()->withErrors();
        }
    }

    public function store(StoreBankAccountRequest $request){
        try{
            $this->entity->user = auth()->id();
            $this->entity->iban = 'IR'.$request->input('iban');
            $this->entity->account = $request->input('account');
            $this->entity->card = $request->input('card');
            $this->entity->photo = $request->file('photo')->store('bank-accounts');
            $this->entity->save();
            ActivityHelper::store(auth()->id(), 'حساب بانکی شما به شماره شبا '.$request->input('iban').' ثبت شد.');
            SendSMS::dispatch(SMSType::MILAD, config('azarsarmaye.milad.mobile'), 'ثبت حساب بانکی', SMSTemplate::MILAD);
            return redirect()->route('bankAccounts.index');
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back()->withInput()->withErrors();
        }
    }

    public function destroy($uuid){
        try{
            $bankAccount = BankAccount::where(['uuid' => $uuid, 'user_id' => auth()->id()])->first();
            if ($bankAccount == null){
                return back()->with(['error' => 'خطایی در اجرای درخواست شما بوجود آمده است.']);
            }
            $this->entity->find($bankAccount->id)->delete();
            return redirect()->route('bankAccounts.index');
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back()->withInput()->withErrors(['error' => 'خطایی در اجرای درخواست شما بوجود آمده است.']);
        }
    }

}
