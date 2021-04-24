<?php


namespace App\Http\Controllers;


use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function index(){
        $items = Account::me()->latest()->paginate(15);
        return view('accounts.index', compact('items'));
    }

    public function store(Request $r){
        try{
            $account = $r->validate([
                'name' => 'required',
                'type' => 'required',
                'currency' => 'required'
            ]);
            $account['user_id'] = auth()->id();
            $account['number'] = random_int(124778554,9999999999);
            Account::create($account);
            return redirect()->route('panel.accounts.index');
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }
}
