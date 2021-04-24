<?php


namespace App\Http\Controllers\Investment;


use App\Enums\Investment\Period;
use App\Enums\Investment\Type;
use App\Enums\UAccount\Status;
use App\Http\Controllers\MAccount\MAccount;
use App\Http\Controllers\Transaction\Transaction;
use App\Http\Requests\InvestmentStoreRequest;
use Illuminate\Support\Str;

class Controller extends \App\Http\Controllers\Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new Investment();
    }

    public function index()
    {
        $page_title = 'Investments';
        $page_description = 'Get it to the Uinvest family';
        $items = Investment::me()->latest()->get();
        return view('investments.index', compact('page_title', 'page_description', 'items'));
    }

    public function new()
    {
        $page_title = 'New Investment';
        $page_description = 'Turn your feature into Uinvest family.';
        return view('investments.new', compact('page_title', 'page_description'));
    }

    public function store(InvestmentStoreRequest $r)
    {
        $amount = $r->input('amount');
        $cryptocurrency = $r->input('cryptocurrency');
        $period = $r->input('period');
        switch ((int)$period) {//TODO: this needs to be in a helper or model function for consistency between web and apis.
            default:
            case Period::SILVER:
                $target = 100;
                break;
            case Period::GOLD:
                $target = 300;
                break;
            case Period::DIAMOND:
                $target = 500;
                break;
        }
        $this->model->amount = $amount;
        $this->model->initial_deposit = $amount;
        $this->model->cryptocurrency = $cryptocurrency;
        $this->model->branch_id = 4234;
        $this->model->account_id = auth()->id();
        $this->model->target = $target;
        $this->model->matching = 0;
        $this->model->save();
        $uaccount = new MAccount();
        $uaccount->account_id = 1916628; //TODO: needs update
        $uaccount->investment_id = $this->model->id;
        $uaccount->status = Status::IN_PROGRESS;
        $uaccount->save();
        $acc = auth()->id();
        $description = $r->input('description');
        $transaction = new Transaction();
        $transaction->account_id = $acc;
        $transaction->no = random_int(100000, 999999); //TODO: no is not guaranteed to be unique here.
        $transaction->type = \App\Enums\Transaction\Type::DEPOSIT;
        $transaction->from = 0;
        $transaction->to = $acc;
        $transaction->amount = $amount;
        $transaction->description = $description;
        $transaction->authority = Str::random(16);
        $transaction->cryptocurrency = $cryptocurrency;
        $transaction->save();

        return redirect()->route('transactions.transfer', ['uuid' => $transaction->uuid]);
    }

}
