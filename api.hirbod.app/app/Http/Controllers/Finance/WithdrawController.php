<?php


namespace App\Http\Controllers\Finance;


use App\Http\Controllers\Controller;

class WithdrawController extends Controller
{

    private $entity;

    public function __construct()
    {
        $this->entity = new Withdraw();
    }

    public function index(){
        return view('withdraw.list', ['withdraws' => Withdraw::me()->latest()->paginate(15)]);
    }

//    public function create(){
//        return view('withdraw.create', ['accounts' => BankAccount::me()->get()]);
//    }

}