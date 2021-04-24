<?php

namespace Services\Withdraw\Repositories;

use Services\Withdraw\Models\Withdraw;
use App\Repository\Repository;

/**
 * Withdraw
 * @author Sajadweb
 * Sun Dec 27 2020 13:31:04 GMT+0330 (Iran Standard Time)
 */
class WithdrawRepository extends Repository implements IWithdrawRepository
{
      /**
     * The model being queried.
     *
     * @var Withdraw
     */
    public $model;
    public function __construct(Withdraw $model)
    {
        $this->model = new $model();
    }
}