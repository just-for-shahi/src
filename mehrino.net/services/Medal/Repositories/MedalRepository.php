<?php

namespace Services\Medal\Repositories;

use Services\Medal\Models\Medal;
use App\Repository\Repository;

/**
 * Medal
 * @author Sajadweb
 * Fri Dec 25 2020 13:23:17 GMT+0330 (Iran Standard Time)
 */
class MedalRepository extends Repository implements IMedalRepository
{
      /**
     * The model being queried.
     *
     * @var Medal
     */
    public $model;
    public function __construct(Medal $model)
    {
        $this->model = new $model();
    }
}