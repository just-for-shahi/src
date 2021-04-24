<?php


namespace App\Http\Controllers\Finance;


use App\Helpers\Payment;
use App\HModels\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\PayWalletRequest;
use Illuminate\Support\Str;

class WalletController extends Controller
{

    public function show(){
        try{
            $balance = auth()->user()->balance;
            return view('wallet', compact('balance'));
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public function pay(PayWalletRequest $r){
        try{
            $usr = auth()->user();
            $amount = intval($r->input('amount'));
            $transaction = Transaction::create([
                'user' => $usr->id,
                'amount' => $amount,
                'description' => '  شارژ کیف‌پول هیربد به مبلغ '.$amount,
                'authority' => Str::random(),
                'pricable_type' => User::class,
                'pricable_id' => $usr->id
            ]);
            $payment = new Payment();
            return redirect($payment->pay($transaction->id));
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

}
