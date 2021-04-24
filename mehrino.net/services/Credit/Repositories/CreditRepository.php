<?php

namespace Services\Credit\Repositories;

use Services\Credit\Models\Credit;
use App\Repository\Repository;

/**
 * Credit
 * @author Sajadweb
 * Sun Dec 27 2020 13:50:31 GMT+0330 (Iran Standard Time)
 */
class CreditRepository extends Repository implements ICreditRepository
{
      /**
     * The model being queried.
     *
     * @var Credit
     */
    public $model;
    public function __construct(Credit $model)
    {
        $this->model = new $model();
    }
}