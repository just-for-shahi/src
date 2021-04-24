<?php
namespace Services\Like\Repositories;

use Services\Like\Models\Like;
use App\Repository\IRepository;

/**
 * Like
 * @author Sajadweb
 * Fri Dec 25 2020 02:40:00 GMT+0330 (Iran Standard Time)
 */
interface ILikeRepository extends IRepository
{
    public function action($records, $action);
}
