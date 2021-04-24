<?php

namespace Services\Share\Repositories;

use Services\Share\Models\Share;
use App\Repository\Repository;

/**
 * Share
 * @author Sajadweb
 * Fri Dec 25 2020 02:41:23 GMT+0330 (Iran Standard Time)
 */
class ShareRepository extends Repository implements IShareRepository
{
      /**
     * The model being queried.
     *
     * @var Share
     */
    public $model;
    public function __construct(Share $model)
    {
        $this->model = new $model();
    }
}