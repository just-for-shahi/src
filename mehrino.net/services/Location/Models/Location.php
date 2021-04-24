<?php

namespace Services\Location\Models;

use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Location
 * @author Sajadweb
 * Wed Jan 13 2021 17:38:02 GMT+0330 (Iran Standard Time)
 */
class Location extends Model
{
    use UUID, SoftDeletes, Latest;

    protected $guarded = ['id'];
}