<?php

namespace Services\Follow\Repositories;

use Services\Follow\Models\Follow;
use App\Repository\Repository;

/**
 *Follow
 * @author Sajadweb
 * Sat Jan 09 2021 19:57:43 GMT+0330 (Iran Standard Time)
 */
class FollowRepository extends Repository implements IFollowRepository
{
    /**
     * The model being queried.
     *
     * @varFollow
     */
    public $model;

    public function __construct(Follow $model)
    {
        $this->model = new $model();
    }

}
