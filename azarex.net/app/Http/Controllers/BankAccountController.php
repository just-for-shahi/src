<?php


namespace App\Http\Controllers;


use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{

    public function index(){
        $items = BankAccount::me()->latest()->paginate(15);
        return view('bankAccounts.index', compact('items'));
    }

    public function store(Request $r){
        try{
            $bankAccount = $r->validate([
                'iban' => 'required',
                'card' => 'required',
                'account' => 'required'
            ]);
            $bankAccount['user_id'] = auth()->id();
            BankAccount::create($bankAccount);
            return redirect()->route('panel.bankAccounts.index');
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }
}
