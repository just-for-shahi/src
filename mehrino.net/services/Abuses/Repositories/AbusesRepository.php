<?php

namespace Services\Abuses\Repositories;

use Services\Abuses\Models\Abuses;
use App\Repository\Repository;

/**
 * Abuses
 * @author Sajadweb
 * Sun Dec 27 2020 14:11:39 GMT+0330 (Iran Standard Time)
 */
class AbusesRepository extends Repository implements IAbusesRepository
{
      /**
     * The model being queried.
     *
     * @var Abuses
     */
    public $model;
    public function __construct(Abuses $model)
    {
        $this->model = new $model();
    }
}