<?php


namespace App\Http\Controllers\Milad;


use App\Helpers\ActivityHelper;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\BankTransfer;
use App\Models\Investment;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BankTransferController extends Controller
{

    private $entity;

    public function __construct()
    {
        $this->entity = new BankTransfer();
    }
    public function index(){
        return view('bank-payment.list', ['bankTransfers' => BankTransfer::latest()->paginate(15)]);
    }

    public function create(){
        return view('bank-payment.create', [
            'accounts' => Account::all()
        ]);
    }

    public function store(Request $r){
        $receipt = null;
        if ($r->hasFile('receipt')){
            $receipt = $r->file('receipt')->store(date('Y-m').'/bank-transfers/');
        }
        $account = $r->input('account');
        $usr = auth()->id();
        $amount = $r->input('amount');
        $transaction = Transaction::create([
            'user_id' => $usr,
            'from' => 0,
            'to' => $account,
            'amount' => $amount,
            'description' => 'انتقال بانکی',
            'authority' => 'BTI'.random_int(100000,99999999),
            'status' => 0,
            'gateway' => 0
        ]);
        $this->entity->user_id = $usr;
        $this->entity->account = $account;
        $this->entity->transaction = $transaction->id;
        $this->entity->amount = $amount;
        $this->entity->receipt = $receipt;
        $this->entity->save();
        return redirect()->route('bank-transfers.index');
    }

    public function accept($id){
        BankTransfer::where('id', $id)->update(['status' => 1]);
        $bankTransfer = BankTransfer::find($id);
        ActivityHelper::store($bankTransfer->user, 'انتقال بانکی '.$bankTransfer['id'].' تایید شد.');
        Transaction::where('id', $bankTransfer['transaction'])->update(['status' => 1]);
        Investment::create([
            'user_id' => $bankTransfer['user_id'],
            'account' => $bankTransfer['account'],
            'transaction' => $bankTransfer['transaction'],
            'amount' => $bankTransfer['amount'],
            'invested_at' => Carbon::now(),
            'status' => 1
        ]);
        Account::where('id', $bankTransfer['account'])->increment('balance', $bankTransfer['amount']);
        ActivityHelper::store($bankTransfer['user_id'], 'انتقال بانکی شماره '.$bankTransfer['id'].' شما تایید و به حساب مالی مدنظر واریز شد.');
        return redirect()->route('mbank-transfers.index');
    }

}
