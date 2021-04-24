<?php

namespace Services\Credit\Models;

use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Credit
 * @author Sajadweb
 * Sun Dec 27 2020 13:50:31 GMT+0330 (Iran Standard Time)
 */
class Credit extends Model
{
    use UUID, SoftDeletes, Latest;

    protected $guarded = ['id'];
}