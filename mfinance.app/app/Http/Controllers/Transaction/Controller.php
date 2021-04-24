<?php


namespace App\Http\Controllers\Transaction;


use App\Enums\Transaction\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Controller extends \App\Http\Controllers\Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new Transaction();
    }

    public function index()
    {
        $page_title = 'Transactions';
        $items = Transaction::me()->latest()->paginate();

        return view('transactions.index', compact('page_title', 'items'));
    }

    public function deposit()
    {
        $page_title = 'Deposit to Uinvest';
        return view('transactions.deposit', compact('page_title'));
    }

    public function deposited(Request $r)
    {
        $acc = auth()->id();
        $amount = $r->input('amount');
        $cryptocurrency = $r->input('cryptocurrency');
        $description = $r->input('description');
        $this->model->account_id = $acc;
        $this->model->no = random_int(1000000, 9999999); //TODO: not guaranteed to be always unique
        $this->model->type = Type::DEPOSIT;
        $this->model->from = 0;
        $this->model->to = $acc;
        $this->model->amount = $amount;
        $this->model->description = $description;
        $this->model->authority = Str::random(16);
        $this->model->cryptocurrency = $cryptocurrency;
        $this->model->save();

        return redirect()->route('transactions.transfer', ['uuid' => $this->model->uuid]);
    }

    public function transfer($uuid)
    {
        $transaction = Transaction::uuid($uuid)->firstOrFail();

        $page_title = 'Transfer Amount';
        return view('transactions.transfer', compact('page_title', 'transaction'));
    }

}
