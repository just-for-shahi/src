<?php


namespace App\Http\Controllers;


use App\Helpers\AccountHelper;
use App\Helpers\ActivityHelper;
use App\Helpers\PaymentHelper;
use App\Http\Requests\StoreAccountRequest;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\Wallet;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Http\Request;
use Mockery\Exception;

class AccountController extends Controller
{
    private $entity;

    public function __construct()
    {
        $this->entity = new Account();
    }

    public function index(){
        try{
            return view('account.list', [
                'accounts' => Account::where('user_id', auth()->id())->with("investments")->latest()->paginate(15),
                'wallets' => Wallet::me()->latest()->get()
            ]);
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back()->withInput()->withErrors();
        }
    }

    public function store(StoreAccountRequest $request){
        try{
            $this->entity->user = auth()->id();
            $this->entity->no = AccountHelper::no();
            $this->entity->name = $request->input('name');
            $this->entity->color = $request->input('color');
            $this->entity->balance = 0;
            $this->entity->status = 0;
            $this->entity->save();
            ActivityHelper::store(auth()->id(), 'حساب مالی شما به شماره '.$this->entity->no.' با موفقیت افتتاح شد.');
            return redirect()->route('accounts.index');
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back()->withInput()->withErrors();
        }
    }

        public function destroy($uuid){
            try{
                $accounts = Account::where(['user_id' => auth()->id()])->get();
                if (count($accounts) === 1){
                    return back();
                }
                $account = Account::where(['uuid' => $uuid, 'user_id' => auth()->id()])->first();
                if ($account == null){
                    return back()->with(['error' => 'خطایی در اجرای درخواست شما بوجود آمده است.']);
                }
                if ($account->balance != 0){
                    return back()->withInput()->with(['error' => 'موجودی حساب جهت انحلال باید صفر باشد.']);
                }
                $this->entity->find($account->id)->delete();
                return redirect()->route('accounts.index');
            }catch (\Exception $e){
                return dd($e->getMessage());
                Bugsnag::notifyException($e);
                return back()->withInput()->withErrors(['error' => 'خطایی در اجرای درخواست شما بوجود آمده است.']);
            }
        }

        public function charge($uuid, Request $r){
            try{
                $account = Account::where(['uuid' => $uuid, 'user_id' => auth()->id()])->first();
                if ($account === null){
                    return abort(404);
                }
                $amount = $r->input('amount');
                if (intval($amount) < 100){
                    return back();
                }
                Transaction::create([
                    'user_id' => auth()->id(),
                    'from' => $r->input('wallet'),
                    'to' => $account['id'],
                    'amount' => $amount,
                    'description' => 'افزایش موجودی حساب مالی  '.$account['no'],
                    'authority' => intval('00' . random_int(10000, 99999)),
                    'status' => 0,
                    'gateway' => 1,
                ]);
                return redirect()->route('accounts.charging', ['uuid' => $account['uuid']]);
            }catch (\Exception $e){
                Bugsnag::notifyExeption($e);
                return redirect()->route('accounts.index');
            }
        }

    public function charging(){
        try{
            return view('account.charge');
        }catch (Exception $e){
            return abort(500);
        }
    }
}
