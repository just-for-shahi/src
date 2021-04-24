<?php

namespace Services\Like\Repositories;

use Services\Like\Models\Like;
use App\Repository\Repository;

/**
 * Like
 * @author Sajadweb
 * Fri Dec 25 2020 02:40:00 GMT+0330 (Iran Standard Time)
 */
class LikeRepository extends Repository implements ILikeRepository
{
      /**
     * The model being queried.
     *
     * @var Like
     */
    public $model;
    public function __construct(Like $model)
    {
        $this->model = new $model();
    }

    public function action($records, $action)
    {
        $this->model->user = auth()->id();
        $this->model->action = $action;
        return $records->save($this->model);
    }
}
