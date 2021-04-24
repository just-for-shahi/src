<?php


namespace App\Http\Controllers\BankAccount;


use App\Enums\Account\Role;
use App\Http\Requests\BankAccountStoreRequest;

class Controller extends \App\Http\Controllers\Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new BankAccount();
    }

    public function index(){
        try{
            $page_title = 'Bank Accounts';
            $page_description = 'List of your bank accounts.';
            $items = BankAccount::me()->latest()->paginate();
            if (auth()->user()->role === Role::ADMIN){
                $items = BankAccount::latest()->paginate();
            }
            return view('bank-accounts.index', compact('page_title', 'page_description', 'items'));
        }catch (\Exception $e){
            return dd($e);
        }
    }

    public function new(){
        try{
            $page_title = 'New Bank Account';
            $page_description = 'Register new bank account.';
            return view('bank-accounts.new',compact('page_title', 'page_description'));
        }catch (\Exception $e){
            return dd($e);
        }
    }

    public function store(BankAccountStoreRequest $r){
        try{
            $this->model->account_id = auth()->id();
            $this->model->currency = $r->input('currency');
            $this->model->iban = $r->input('iban');
            $this->model->card = $r->input('card');
            $this->model->no = $r->input('no');
            $this->model->swift = $r->input('swift');
            $this->model->save();
            return redirect()->route('bankAccounts.index');
        }catch (\Exception $e){
            return dd($e);
        }
    }

}
