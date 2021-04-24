<?php


namespace App\Http\Controllers;


use App\Models\Exchange;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{

    public function index(){
        $items = Exchange::me()->latest()->paginate(15);
        return view('exchanges.index', compact('items'));
    }

    public function store(Request $r){
        try{
            $userID = auth()->id();
            $data = $r->validate([
                'amount' => 'required',
                'type' => 'required',
                'currency' => 'required',
                'destination' => 'required',
                'description' => 'required'
            ]);
            $transaction = Transaction::create([
                'user_id' => $userID,
                'currency' => $data['currency'],
                'amount' => $data['amount'],
                'balance' => auth()->user()->balance,
                'type' => \App\Enums\Transaction::EXCHANGE,
                'status' => \App\Enums\Transaction::SUCCESSFUL,
                'ip' => $r->getClientIp(),
            ]);
            $data['user_id'] = $userID;
            $data['transaction_id'] = $transaction['id'];
            $data['rate'] = 1; // @TODO:Add rates from DB
            Exchange::create($data);
            return redirect()->route('panel.exchanges.index');
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

}
