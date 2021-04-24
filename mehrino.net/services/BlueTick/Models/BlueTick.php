<?php

namespace Services\BlueTick\Models;

use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * BlueTick
 * @author Sajadweb
 * Sun Dec 27 2020 14:10:25 GMT+0330 (Iran Standard Time)
 */
class BlueTick extends Model
{
    use UUID, SoftDeletes, Latest;

    protected $guarded = ['id'];
}