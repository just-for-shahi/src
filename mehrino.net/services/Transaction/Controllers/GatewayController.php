<?php

namespace Services\Transaction\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Project\Models\Project;
use Services\Transaction\Enum\Status;
use Services\Transaction\Enum\Type;
use Services\Transaction\Repositories\ITransactionRepository;
use Services\Transaction\Models\Transaction;
use Services\Transaction\Requests\TransactionRequest;
use Services\User\Models\User;
use Services\User\Repositories\IUserRepository;

/**
 * Transaction
 * @author Sajadweb
 * Sun Dec 27 2020 14:05:43 GMT+0330 (Iran Standard Time)
 */
class GatewayController extends Controller
{

    private $repository;

    public function __construct(ITransactionRepository $repository)
    {
        // todo add repo
        $this->repository = $repository;
    }

    public function start_payment($authority)
    {
        // here we send user to bank gateway
        $txn = $this->repository->findAuthority($authority);
        if ($txn) {
            $gateway_url = route('test_gateway', [
                'authority' => $authority
            ]);
            return redirect()->to($gateway_url);
        }
    }

    public function callback_payment(Request $request, $authority)
    {
        // here we verify user payment
        if ($request->has('status')) {
            switch ($request->status) {
                case Status::PAID:
                    // add balance
                    $txn = $this->repository->findAuthority($authority);
                    if ($txn && $txn->status === Status::REGISTERED) {
                        $user = $txn->user()->first();
                        if ($txn->type == Type::WALLET) {
                            $user->balance = $user->balance + $txn->amount;
                            if ($user->save()) {
                                $txn->status = Status::PAID;
                                $txn->save();
                            }
                        } elseif ($txn->type == Type::PURCHASE) {
                            $project = $txn->transactional;
                            if ($project) {
                                $project->current_balance = $project->current_balance + $txn->amount;
                                if (!$project->transactions()->where('status', Status::PAID)->where('user', $txn->user()->first()->id)->first())
                                    $project->collaborators += 1;
                                if ($project->save()) {
                                    $txn->status = Status::PAID;
                                    if ($txn->save()) {
                                        if ($txn->related_txn()->update(['status' => Status::PAID])) {
                                            if ($txn->related_txn->amount !== $txn->amount) { // use_wallet = (bool) true
                                                $user->balance = 0;
                                                $user->save();
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    return view('test_gateway.success');
                    break;
                default:
                case Status::FAILED:
                    return view('test_gateway.fail');
                    break;
            }
        }
    }

    public function test_gateway($authority)
    {
        return view('test_gateway.gateway', [
            'authority' => $authority
        ]);
    }
}
