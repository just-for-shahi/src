<?php

namespace Services\BankAccount\Repositories;

use Services\BankAccount\Models\BankAccount;
use App\Repository\Repository;

/**
 * BankAccount
 * @author Sajadweb
 * Sun Dec 27 2020 13:30:10 GMT+0330 (Iran Standard Time)
 */
class BankAccountRepository extends Repository implements IBankAccountRepository
{
      /**
     * The model being queried.
     *
     * @var BankAccount
     */
    public $model;
    public function __construct(BankAccount $model)
    {
        $this->model = new $model();
    }
}