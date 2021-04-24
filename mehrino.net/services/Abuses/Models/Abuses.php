<?php

namespace Services\Abuses\Models;

use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Abuses
 * @author Sajadweb
 * Sun Dec 27 2020 14:11:39 GMT+0330 (Iran Standard Time)
 */
class Abuses extends Model
{
    use UUID, SoftDeletes, Latest;

    protected $guarded = ['id'];
}