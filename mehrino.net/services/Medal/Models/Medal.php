<?php

namespace Services\Medal\Models;

use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Medal
 * @author Sajadweb
 * Fri Dec 25 2020 13:23:17 GMT+0330 (Iran Standard Time)
 */
class Medal extends Model
{
    use UUID, SoftDeletes, Latest;

    protected $guarded = ['id'];
}