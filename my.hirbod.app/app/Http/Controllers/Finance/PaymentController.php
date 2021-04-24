<?php


namespace App\Http\Controllers\Finance;


use App\Helpers\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function payment($uuid){
        try{
            $transaction = Transaction::findUUID($uuid);
            $payment = new Payment();
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
                $payment = new Payment();
                $payment->verify($authority);
            }
            return redirect()->route('transactions.index');
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

}
