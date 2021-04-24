<?php


namespace App\Http\Controllers\Finance;


use App\Enums\Finance\Transaction\Type;
use App\Facades\Rest\Rest;
use App\Helpers\Finance\PaymentHelper;
use App\Helpers\Finance\PlusHelper;
use App\Helpers\Finance\WalletHelper;
use App\Helpers\FinanceHelper;
use App\Http\Controllers\Account\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlusController extends Controller
{

    private $obj, $usr, $helper;

    public function __construct()
    {
        $this->obj = new Transaction();
        $this->usr = new User();
        $this->helper = new PaymentHelper();
    }

    public function purchase(Request $r){
        try{
            $amount = FinanceHelper::tmnToRls(PlusHelper::prices($r->input('period')));
            $this->usr = auth('api')->user();
            $this->obj->user = $this->usr->id;
            $this->obj->amount = $amount;
            $this->obj->description = 'Plus Purchase';
            $this->obj->authority = Str::random();
            $this->obj->transactional_id = $this->usr->id;
            $this->obj->transactional_type = User::class;
            $this->obj->type = Type::PLUS;
            $this->obj->save();
            return Rest::success('Payment Initializing', ['pay' => $this->helper->pay($this->obj->uuid)]);
        }catch (\Exception $e){
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