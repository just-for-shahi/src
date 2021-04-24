<?php

namespace Services\Location\Repositories;

use Services\Location\Models\Location;
use App\Repository\Repository;

/**
 * Location
 * @author Sajadweb
 * Wed Jan 13 2021 17:38:02 GMT+0330 (Iran Standard Time)
 */
class LocationRepository extends Repository implements ILocationRepository
{
      /**
     * The model being queried.
     *
     * @var Location
     */
    public $model;
    public function __construct(Location $model)
    {
        $this->model = new $model();
    }
}