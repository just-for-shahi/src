<?php


namespace App\Http\Controllers\Wallet;


use App\Helpers\Wallet\Status;
use App\Http\Requests\WalletStoreRequest;
use App\Scripts\Helpers\ValidationHelper;
use Illuminate\Http\Request;

class Controller extends \App\Http\Controllers\Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new Wallet();
    }

    public function index()
    {
        $page_title = 'Wallets';
        $items = Wallet::me()->latest()->get();

        return view('wallets.index', compact('page_title', 'items'));
    }

    public function new()
    {
        $page_title = 'Register Wallet';
        return view('wallets.new', compact('page_title'));
    }

    public function store(WalletStoreRequest $r)
    {
        $this->model->account_id = auth()->id();
        $this->model->currency = $r->input('currency');
        $this->model->address = $r->input('address');
        $this->model->default = $r->input('default');
        $this->model->dashboard = $r->input('dashboard');
        $this->model->save();

        return redirect()->route('wallets.index');
    }

    public function updateStatus(Wallet $wallet, Request $request)
    {
        authorizeAdminsOnly();
        $request->validate([
            'status' => ValidationHelper::inArray(Status::all())
        ]);

        $wallet->update([
            'status' => $request->status
        ]);

        return back();
    }

    public function destroy(Wallet $wallet)
    {
        //TODO: what's the logic?!
    }

}
