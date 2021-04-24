<?php

namespace Services\BlueTick\Repositories;

use Services\BlueTick\Models\BlueTick;
use App\Repository\Repository;

/**
 * BlueTick
 * @author Sajadweb
 * Sun Dec 27 2020 14:10:25 GMT+0330 (Iran Standard Time)
 */
class BlueTickRepository extends Repository implements IBlueTickRepository
{
      /**
     * The model being queried.
     *
     * @var BlueTick
     */
    public $model;
    public function __construct(BlueTick $model)
    {
        $this->model = new $model();
    }
}