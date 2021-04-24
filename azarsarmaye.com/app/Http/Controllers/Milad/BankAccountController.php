<?php


namespace App\Http\Controllers\Milad;


use App\Helpers\ActivityHelper;
use App\Helpers\SMSHelper;
use App\Http\Controllers\Controller;
use App\Jobs\SendSMS;
use App\Models\BankAccount;
use App\Models\User;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    private $entity;

    public function __construct()
    {
        $this->entity = new BankAccount();
    }

    public function index()
    {
        return view('admin.bank-account.list', ['bank_accounts' => BankAccount::with('user')
            ->latest()->paginate(15)]);
    }

//    public function create(){
//        return view('admin.bank-account.create');
//    }

    public function store(Request $request)
    {
        $user = User::getByUsername();

        $this->entity->user_id = $user->id;
        $this->entity->iban = $request->input('iban');
        $this->entity->account = $request->input('account');
        $this->entity->card = $request->input('card');
        $this->entity->save();

        ActivityHelper::store($this->entity->user_id, 'حساب بانکی شما به شماره شبا ' . $request->input('iban') . ' ثبت شد.');
        return back();
    }

    public function accept(BankAccount $bankAccount)
    {
        $bankAccount->update(['status' => BankAccount::CONFIRMED]);
        $user = $bankAccount->user;
        ActivityHelper::store($user['id'], 'حساب بانکی ' . $bankAccount['iban'] . ' تائید شد.');
        SendSMS::dispatch('sms', $user['mobile'], $bankAccount['iban'], 'azarsarmaye-bankaccount');

        return back();
    }

    public function destroy(BankAccount $bankAccount)
    {
        \Gate::authorize('access-entity', $bankAccount);

        $bankAccount->delete();

        flash('deleted');
        return back();
    }

}
