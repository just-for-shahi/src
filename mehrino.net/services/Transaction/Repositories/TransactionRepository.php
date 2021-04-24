<?php

namespace Services\Transaction\Repositories;

use Illuminate\Http\Request;
use Services\Transaction\Models\Transaction;
use App\Repository\Repository;
use Services\Transaction\Response\ResTransaction;
use Illuminate\Support\Str;

/**
 * Transaction
 * @author Sajadweb
 * Sun Dec 27 2020 14:05:43 GMT+0330 (Iran Standard Time)
 */
class TransactionRepository extends Repository implements ITransactionRepository
{
      /**
     * The model being queried.
     *
     * @var Transaction
     */
    public $model;
    public function __construct(Transaction $model)
    {
        $this->model = new $model();
    }


    public function store($data)
    {
        return $this->model->create($data);
    }

    public function findAuthority($authority)
    {
        $txn = $this->model->where('authority', $authority)->first();
        if ($txn) {
            return $txn;
        }
        return false;
    }

    public function createAuthority()
    {
        return Str::random();
    }

    public function updated($uuid, Request $request)
    {
        return [];
    }

    public function show($uuid)
    {

    }

    public function mapper($res)
    {
        $story = new ResTransaction();
        $data = [];
        foreach ($res as $item) {
            $data[] = $story->setUuid($item->uuid)
                ->setAmount($item->amount)
                ->setAuthority($item->authority)
                ->setDescription($item->description)
                ->setCardNumber($item->card_number )
                ->setTraceNumber($item->trace_number)
                ->setStatus($item->status )
                ->setCreatedAt($item->jCreated )
                ->setUpdatedAt($item->jUpdated )
                ->toArray();
        }
        return $data;
    }

    public function paginate(int $count = 15, int $page = 1, array $columns = ['*'])
    {
        return $this->model->me()->latest()->paginate($count, $columns, $pageName = null, $page);
    }
}
