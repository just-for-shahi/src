<?php


namespace App\Http\Controllers\Milad;


use App\Enums\SMSTemplate;
use App\Enums\SMSType;
use App\Helpers\ActivityHelper;
use App\Http\Requests\StoreBankAccountRequest;
use App\Http\Requests\StoreWalletRequest;
use App\Jobs\SendSMS;
use App\Models\BankAccount;
use App\Models\User;
use App\Models\Wallet;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Mockery\Exception;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    private $entity;

    public function __construct()
    {
        $this->entity = new Wallet();
    }

    public function index()
    {
        return view('admin.wallet.list',
            [
                'wallets' => Wallet::latest()->with('user')->paginate(15)
            ]);
    }

    public function store(StoreWalletRequest $request)
    {
        $this->entity->user_id = User::getByUsername()->id;
        $this->entity->address = $request->input('address');
        $this->entity->currency = $request->input('currency');
        $this->entity->save();
        ActivityHelper::store($this->entity->user_id, 'کیف پول رمزارز شما به آدرس ' . $request->input('address') . ' ثبت شد.');

        return back();
    }

    public function destroy(Wallet $wallet)
    {
        $wallet->delete();

        return back();
    }

    public function accept(Wallet $wallet)
    {
        $wallet->update([
            'status' => Wallet::CONFIRMED
        ]);

        flash('success');
        return back();
    }

}
