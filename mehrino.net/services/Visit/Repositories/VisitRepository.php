<?php

namespace Services\Visit\Repositories;

use Services\Visit\Models\Visit;
use App\Repository\Repository;

/**
 * Visit
 * @author Sajadweb
 * Fri Dec 25 2020 02:43:12 GMT+0330 (Iran Standard Time)
 */
class VisitRepository extends Repository implements IVisitRepository
{
      /**
     * The model being queried.
     *
     * @var Visit
     */
    public $model;
    public function __construct(Visit $model)
    {
        $this->model = new $model();
    }
}