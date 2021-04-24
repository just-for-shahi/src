<?php

namespace Services\Leaderboard\Models;

use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Leaderboard
 * @author Sajadweb
 * Fri Dec 25 2020 02:39:39 GMT+0330 (Iran Standard Time)
 */
class Leaderboard extends Model
{
    use UUID, SoftDeletes, Latest;

    protected $guarded = ['id'];
}