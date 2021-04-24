<?php


namespace App\Http\Controllers\Finance;


use App\Http\Controllers\Controller;

class TransactionController extends Controller
{

    public function index(){
        try{
            return view('transaction.list', ['transactions' => Transaction::where('user', auth()->id())->latest()->paginate(15)]);
        }catch (\Exception $e){
            return back()->withInput()->withErrors();
        }
    }

    public function show($transaction){
        try{
            $transaction = Transaction::where(['uuid' => $transaction, 'user' => auth()->id()])->first();
            if ($transaction === null){
                return redirect()->route('transactions.index');
            }
            return view('transaction.show', ['transaction' => $transaction]);
        }catch (\Exception $e){
            return back()->withInput()->withErrors();
        }
    }

}
