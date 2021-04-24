<?php

namespace Services\Event\Models;

use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Event
 * @author Sajadweb
 * Fri Dec 25 2020 02:39:05 GMT+0330 (Iran Standard Time)
 */
class Event extends Model
{
    use UUID, SoftDeletes, Latest;

    protected $guarded = ['id'];
}