<?php

namespace Services\Setting\Models;

use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Setting
 * @author Sajadweb
 * Fri Dec 25 2020 02:40:53 GMT+0330 (Iran Standard Time)
 */
class Setting extends Model
{
    use SoftDeletes, Latest;

    protected $hidden = ['id', 'user', 'created_at', 'updated_at', 'deleted_at'];

    protected $fillable = ['user', 'theme', 'kids_mode', 'notifications', 'sms', 'ads'];

}
