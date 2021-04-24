<?php


namespace App\Http\Controllers;


use App\Enums\SMSTemplate;
use App\Enums\SMSType;
use App\Helpers\ActivityHelper;
use App\Http\Requests\StoreBankAccountRequest;
use App\Http\Requests\StoreWalletRequest;
use App\Jobs\SendSMS;
use App\Models\Wallet;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Mockery\Exception;

class WalletController extends Controller
{
    private $entity;

    public function __construct()
    {
        $this->entity = new Wallet();
    }

    public function index(){
        try{
            return view('wallet.list', ['wallets' => Wallet::where('user_id', auth()->id())->latest()->paginate(15)]);
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back()->withInput()->withErrors();
        }
    }

    public function store(StoreWalletRequest $request){
        try{
            $this->entity->user_id = auth()->id();
            $this->entity->address = $request->input('address');
            $this->entity->currency = $request->input('currency');
            $this->entity->save();
            ActivityHelper::store(auth()->id(), 'کیفپول رمزارز شما به آدرس '.$request->input('address').' ثبت شد.');
            return redirect()->route('wallets.index');
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back()->withInput()->withErrors();
        }
    }

    public function destroy($uuid){
        try{
            $bankAccount = Wallet::where(['uuid' => $uuid, 'user_id' => auth()->id()])->first();
            if ($bankAccount == null){
                return back()->with(['error' => 'خطایی در اجرای درخواست شما بوجود آمده است.']);
            }
            $this->entity->find($bankAccount->id)->delete();
            return redirect()->route('wallets.index');
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back()->withInput()->withErrors(['error' => 'خطایی در اجرای درخواست شما بوجود آمده است.']);
        }
    }

}
