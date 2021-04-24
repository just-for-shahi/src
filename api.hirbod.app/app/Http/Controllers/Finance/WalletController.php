<?php


namespace App\Http\Controllers\Finance;


use App\Enums\Finance\Transaction\Type;
use App\Facades\Rest\Rest;
use App\Helpers\Finance\PaymentHelper;
use App\Helpers\FinanceHelper;
use App\Http\Controllers\Account\User;
use App\Http\Controllers\Controller;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WalletController extends Controller
{

    private $obj, $usr, $helper;

    public function __construct()
    {
        $this->obj = new Transaction();
        $this->usr = new User();
        $this->helper = new PaymentHelper();
    }

    public function charge(Request $r){
        try{
            $amount = $r->input('amount');
            $this->usr = auth('api')->user();
            $this->obj->user = $this->usr->id;
            $this->obj->amount = $amount;
            $this->obj->description = 'Charge Wallet';
            $this->obj->authority = Str::random();
            $this->obj->transactional_id = $this->usr->id;
            $this->obj->transactional_type = User::class;
            $this->obj->type = Type::WALLET;
            $this->obj->save();
            return Rest::success('Payment Initializing', ['url' => $this->helper->payRest($this->obj->uuid)]);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

    public function chargePhone(Request $request)
    {
        try {
            $validator = Validator::make($request->all() , [
                'mobile' => 'required|string',
                'amount' => 'required|string',
                'token' => ['required' , new Recaptcha]
            ]);

            if ($validator->fails()) {
                return Rest::badRequest($validator->errors());
            }

            $amount = $request->amount;
            $mobile = checkZeroFirst(trim($request->mobile));
            $user = User::whereMobile($mobile)->first();

            if (!$user) {
                return Rest::notFound();
            }

            $transaction = Transaction::create([
                'user' => $user->id,
                'amount' => $amount,
                'description' => __('message.finance.chargeWallet'),
                'authority' => Str::random(),
                'transactional_id' => $user->id,
                'transactional_type' => get_class($user),
                'type' => Type::WALLET
            ]);

            return Rest::success('Payment Initializing', ['url' => $this->helper->payRest($transaction->uuid)]);
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    public function callback(Request $r){
        try{
            $token = $r->input('token');
            $status = $r->input('status');
            if (intval($status) === 1){
                $verify = $this->helper->verify($token);
                if ($verify){
                    $transaction = Transaction::where('authority', $token)->first();
                    if ($transaction != null){
                        $user = User::find($transaction['user']);
                        if ($user != null){
                            $user->increment('balance', $transaction['amount']);
                        }
                    }
                }
            }
        }catch (\Exception $e){
            Rest::error($e);
        }
        return redirect('https://hirbod.ac/pg/'.$r->input('token'));
    }

}