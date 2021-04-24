<?php

namespace Services\Share\Models;

use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Share
 * @author Sajadweb
 * Fri Dec 25 2020 02:41:23 GMT+0330 (Iran Standard Time)
 */
class Share extends Model
{
    use UUID, SoftDeletes, Latest;

    protected $guarded = ['id'];
}