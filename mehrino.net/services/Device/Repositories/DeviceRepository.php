<?php

namespace Services\Device\Repositories;

use Services\Device\Models\Device;
use App\Repository\Repository;

/**
 * Device
 * @author Sajadweb
 * Sun Dec 27 2020 13:25:38 GMT+0330 (Iran Standard Time)
 */
class DeviceRepository extends Repository implements IDeviceRepository
{
      /**
     * The model being queried.
     *
     * @var Device
     */
    public $model;
    public function __construct(Device $model)
    {
        $this->model = new $model();
    }
}