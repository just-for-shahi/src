<?php


namespace App\Http\Controllers\Milad;


use App\Helpers\PaymentHelper;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Investment;
use App\Models\Transaction;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    private $entity;

    public function __construct()
    {
        $this->entity = new Transaction();
    }

    public function index()
    {
        return view('admin.transaction.list', [
            'transactions' => Transaction::with(['user'])->latest()->paginate(15)
        ]);
    }

    public function show($transaction)
    {
        $transaction = Transaction::where(['id' => $transaction])->first();
        return view('admin.transaction.show', ['transaction' => $transaction]);
    }

    public function callback(Request $request)
    {
        $client = new Client(['verify' => false]);
        if ((int)$request['status'] === 1) {
            $this->entity = Transaction::where(['user_id' => auth()->id(), 'authority' => $request['token']])->first();
            $result = $client->post(config('uinvest.pay.url') . 'verify', [
                'form_params' => [
                    'gateway' => config('uinvest.pay.gateway'),
                    'token' => $this->entity['authority']
                ]
            ]);
            $result = json_decode($result->getBody())->data;
            if ($result->status == 1) {
                $investment = Investment::where('account', $this->entity['to'])->first();
                Investment::where('id', $investment['id'])->update(['invested_at' => Carbon::now()]);
                Account::where('id', $investment['account'])->update(['status' => 1]);
            }
        }
        return redirect()->route('investments.index');
    }

    public function pay($transaction)
    {
        $paymentHelper = new PaymentHelper();
        return $paymentHelper->pay($transaction);
    }
}
