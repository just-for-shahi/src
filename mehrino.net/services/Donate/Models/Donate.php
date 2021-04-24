<?php

namespace Services\Donate\Models;

use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Donate
 * @author Sajadweb
 * Fri Dec 25 2020 02:38:30 GMT+0330 (Iran Standard Time)
 */
class Donate extends Model
{
    use UUID, SoftDeletes, Latest;

    protected $guarded = ['id'];
}