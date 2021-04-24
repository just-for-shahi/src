<?php

namespace Services\Leaderboard\Repositories;

use Services\Leaderboard\Models\Leaderboard;
use App\Repository\Repository;

/**
 * Leaderboard
 * @author Sajadweb
 * Fri Dec 25 2020 02:39:39 GMT+0330 (Iran Standard Time)
 */
class LeaderboardRepository extends Repository implements ILeaderboardRepository
{
      /**
     * The model being queried.
     *
     * @var Leaderboard
     */
    public $model;
    public function __construct(Leaderboard $model)
    {
        $this->model = new $model();
    }
}