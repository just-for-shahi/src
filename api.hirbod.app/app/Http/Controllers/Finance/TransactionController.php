<?php


namespace App\Http\Controllers\Finance;


use App\Enums\Finance\Transaction\Type;
use App\Facades\Rest\Rest;
use App\Helpers\Finance\PaymentHelper;
use App\Helpers\Finance\PlusHelper;
use App\Http\Controllers\Account\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    private $obj, $helper;

    public function __construct()
    {
        $this->obj = new Transaction();
        $this->helper = new PaymentHelper();
    }

    public function index(){
        try{
            $data = [];
            $transactions = Transaction::me()->latest()->paginate(15);
            foreach ($transactions as $item){
                $data[] = [
                    'uuid' => $item->uuid,
                    'amount' => $item->amount,
                    'description' => $item->description,
                    'authority' => $item->authority,
                    'cardNumber' => $item->card_number,
                    'traceNumber' => $item->trace_number,
                    'status' => $item->status,
                    'createdAt' => $item->jCreated,
                    'updatedAt' => $item->jUpdated
                ];
            }
            return Rest::success('Transations Fetched', $data);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

    public function show($uuid){
        try{
            $transaction = Transaction::where(['user' => auth()->id(), 'uuid' => $uuid])->first();
            if ($transaction === null){
                return Rest::notFound();
            }
            $transaction = [
                'uuid' => $transaction['uuid'],
                'amount' => $transaction['amount'],
                'description' => $transaction['description'],
                'authority' => $transaction['authority'],
                'cardNumber' => $transaction['card_number'],
                'traceNumber' => $transaction['trace_number'],
                'status' => $transaction['status'],
                'createdAt' => $transaction['jCreated'],
                'updatedAt' => $transaction['jUpdated']
            ];
            return Rest::success('Transaction Fetched.', $transaction);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

    public function check($authority){
        try{
            $transaction = Transaction::where(['authority' => $authority])->first();
            if ($transaction === null){
                return Rest::notFound();
            }
            $transaction = [
                'amount' => $transaction['amount'],
                'description' => $transaction['description'],
                'authority' => $transaction['authority'],
                'traceNumber' => $transaction['trace_number'],
                'status' => $transaction['status'],
            ];
            return Rest::success('Transaction Checked.', $transaction);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

    public function pay($uuid){
        try{
            $this->obj = Transaction::findUUID($uuid);
            if ($this->obj === null){
                return Rest::notFound();
            }
            return Rest::success('Payment Initializing', ['pay' => $this->helper->pay($uuid)]);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

    public function callback(Request $r){
        try{
            $authority = $r->input('Authority');
            $status = $r->input('Status');
            if ($status == 'OK'){
                $verify = $this->helper->verify($authority);
                if ($verify){
                    $transaction = Transaction::where('authority', $authority)->first();
                    if ($transaction != null){
                        switch ($transaction['type']){
                            case Type::WALLET:
                                $user = User::find($transaction['user']);
                                if ($user != null){
                                    $user->increment('balance', $transaction['amount']);
                                }
                                break;
                            case Type::PLUS:
                                $user = User::find($transaction['user']);
                                if ($user != null){
                                    $plus = Carbon::parse($user['plus']);
                                    $plus = PlusHelper::updatePeriod($plus, PlusHelper::index($transaction['amount']));
                                    User::where('id', $user['id'])->update([
                                        'plus' => $plus
                                    ]);
                                }
                                break;
                            case Type::PURCHASE:
                                //@TODO: Complete this type methods
                                break;
                        }
                    }
                }
            }
        }catch (\Exception $e){
            Rest::error($e);
        }
        return redirect('https://hirbod.ac/pg/'.$authority);
    }

}