<?php

namespace Services\Transaction\Controllers;

use App\Http\Controllers\Controller;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Services\Donate\Models\Donate;
use Services\Project\Models\Project;
use Services\Transaction\Enum\Status;
use Services\Transaction\Enum\Type;
use Services\Transaction\Helpers\PaymentHelper;
use Services\Transaction\Models\Transaction;
use Services\Transaction\Repositories\ITransactionRepository;
use Services\Transaction\Requests\TransactionRequest;
use Services\User\Models\User;

/**
 * Transaction
 * @author Sajadweb
 * Sun Dec 27 2020 14:05:43 GMT+0330 (Iran Standard Time)
 */
class TransactionController extends Controller
{

    private $repository;

    public function __construct(ITransactionRepository $repository)
    {
        // todo add repo
        $this->repository = $repository;
        $this->helper = new PaymentHelper();
    }

    public function index()
    {
        try {
            $result = $this->repository->paginate(x_count(), x_page());
            $data = $this->repository->mapper($result);
            if ($result->count() > 0)
                return Ok($data, [
                    "x-count" => $result->count(),
                    "x-page" => $result->currentPage(),
                ]);
            return NoContent204();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function store(TransactionRequest $request, $service, $uuid = null)
    {
        try {
            DB::beginTransaction();
            $txn = null;
            $user = auth()->user();
            $authority = $this->repository->createAuthority();
            $request->merge([
                'user' => $user->id,
                'authority' => $authority
            ]);
            $request->merge(['type' => $service == 'wallet' ? 0 : 1]);
            $data = $request->only(['amount', 'type', 'user', 'authority']);
            switch ($request->type) {
                case Type::WALLET:
                {
                    $data['description'] = 'افزایش اعتبار حساب کاربری';
                    $txn = $this->repository->store($data);
                    break;
                }
                case Type::PURCHASE:
                {
                    $data['description'] = 'کمک مالی';
                    $project = Project::where('uuid', $uuid)->first();
                    if (!$project) {
                        DB::rollBack();
                        return NotFound404();
                    }
                    if ($request->input('use_wallet', false)) {
                        if ($user->balance > 0) {
                            $balance = $user->balance - $request->amount;
                            $walletData = $data;
                            $walletData['status'] = Status::PAID;
                            $walletData['type'] = Type::WALLET;
                            $walletData['authority'] = $this->repository->createAuthority();;
                            if ($balance >= 0) {
                                $user->balance = $balance;
                            } else {
                                $walletData['amount'] = $user->balance;
                                $data['amount'] = $balance * -1;
                                $user->balance = 0;
                            }

                            $project->current_balance = $project->current_balance + $walletData['amount'];
                            if (!$project->transactions()->where('status', Status::PAID)->where('user', auth()->id())->first())
                                $project->collaborators += 1;

                            if (!$project->save()) {
                                DB::rollBack();
                                return BadRequest400();
                            }
                            if (!$user->save()) {
                                DB::rollBack();
                                return BadRequest400();
                            }
                            if (!$project->transactions()->create($walletData)) {
                                DB::rollBack();
                                return BadRequest400();
                            }
                            if ($balance >= 0) {
                                DB::commit();
                                return OK();
                            }

                        }
                    }
                    $txn = $project->transactions()->create($data);
                    break;
                }
                default:
                {
                    DB::rollBack();
                    return NotFound404();
                    break;
                }
            }
            if ($txn) {
                DB::commit();
                return Created201([
                    'url' => $this->helper->payRest($txn->uuid)
                ]);
            }
            DB::rollBack();
            return NotFound404();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function show($uuid)
    {
        try {
            return Ok($this->repository->show($uuid));
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function update($uuid, Request $request)
    {
        try {
            return Ok($this->repository->update($uuid, $request->all()));
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function destroy($uuid)
    {
        try {
            return Ok($this->repository->destroy($uuid));
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function callback(Request $r){

        try{
            $ok = false;
            $authority = $r->input('Authority');
            $transaction = Transaction::where('authority', $authority)->with(['transactional'])->first();
            $guzzle = new Client([
                'verify' => false
            ]);
            $res = $guzzle->post( 'https://api.zarinpal.com/pg/v4/payment/verify.json', [
                'form_params' => [
                    'merchant_id' => config('mehrino.zp.gateway'),
                    'amount' => $transaction->amount * 10,
                    'authority' => $authority
                ]
            ]);
            $res = json_decode($res->getBody())->data;
            if ($res->code === 100){
                $ok = true;
                $transaction->update([
                    'card_number' => "$res->card_pan",
                    'trace_number' =>"$res->ref_id",
                    'status' => Status::PAID,
                ]);
                $i = $transaction->transactional_type;
                switch ($i) {
                    case Project::class:
                        $project = $transaction->transactional;
                        if ($project) {
                            $project->current_balance = $project->current_balance + $transaction->amount;

                            if (!$project->transactions()->where('status', Status::PAID)->where('user', $transaction->user()->first()->id)->first())
                                $project->collaborators += 1;

                            $project->save();
                        }
                        break;
                    case Donate::class:
                        //TODO for donate
                    default:
                        User::where('id', $transaction->user)->increment('balance', $transaction->amount);
                        break;
                }
            }
        }catch (\Exception $e){
            notifyException($e);
        }
        if ($ok) {
            return view('test_gateway.success' , compact('transaction'));
        }
        return view('test_gateway.fail' , compact('transaction'));
    }
}
