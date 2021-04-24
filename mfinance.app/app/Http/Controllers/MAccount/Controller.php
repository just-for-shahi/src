<?php


namespace App\Http\Controllers\MAccount;



use App\Enums\Account\Role;
use App\Http\Requests\MAccountStoreRequest;
use Illuminate\Http\Request;

class Controller extends \App\Http\Controllers\Controller
{

    private $model;

    public function __construct()
    {
        $this->middleware('auth');
        $this->model = new MAccount();
    }

    public function index(){
        try{
            $page_title = 'UAccounts';
            $items = MAccount::me()->latest()->paginate();
            if (auth()->user()->role === Role::ADMIN){
                $items = MAccount::latest()->paginate();
            }
            return view('maccounts.index', compact('page_title', 'items'));
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public function new(){
        try{
            $page_title = 'New MAccount';
            return view('maccounts.new', compact('page_title'));
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public function store(MAccountStoreRequest $r){
        try{
            $this->model->account_id = auth()->id();
            $this->model->broker = $r->input('broker');
            $this->model->username = $r->input('username');
            $this->model->password = $r->input('password');
            $this->model->investor_password = $r->input('investor-password');
            $this->model->server = $r->input('server');
            $this->model->report = $r->input('report');
            $this->model->dashboard = $r->input('dashboard');
            $this->model->save();
            return redirect()->route('maccounts.index');
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

}
