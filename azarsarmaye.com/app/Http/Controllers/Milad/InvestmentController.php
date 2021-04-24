<?php


namespace App\Http\Controllers\Milad;


use App\Helpers\PaymentHelper;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Investment;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{

    private $entity;

    public function __construct()
    {
        $this->entity = new Investment();
    }

    public function index()
    {
        return view('admin.investment.list', [
            'investments' => Investment::with(['_transaction', 'user'])->latest()->paginate(15),
        ]);
    }

    public function create()
    {
        return view('admin.investment.create', ['accounts' => Account::where('user_id', auth()->id())->get()]);
    }

    public function store(Request $request)
    {
        $account = $request->input('account');
        $amount = (int)$request->input('amount');
        $this->entity->user_id = User::getByUsername()->id;
        $this->entity->account = $account;
        $this->entity->amount = $amount;
        $this->entity->invested_at = null;
        $this->entity->withdraw_at = null;
        $this->entity->status = 0;
        $this->entity->save();
        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'from' => 0,
            'to' => $account,
            'amount' => $amount,
            'description' => 'سرمایه گذاری شماره ' . $this->entity->id,
            'authority' => (int)('00' . random_int(10000000, 99999999)),
            'status' => 0,
            'gateway' => 0,
        ]);
        $this->entity->update(['transaction' => $transaction->id]);

        flash();
        return back();
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy($investment)
    {

    }
}
