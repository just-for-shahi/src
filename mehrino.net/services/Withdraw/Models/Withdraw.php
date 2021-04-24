<?php

namespace Services\Withdraw\Models;

use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Withdraw
 * @author Sajadweb
 * Sun Dec 27 2020 13:31:04 GMT+0330 (Iran Standard Time)
 */
class Withdraw extends Model
{
    use UUID, SoftDeletes, Latest;

    protected $guarded = ['id'];
}