<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class BrokerUser extends Model
{
    use DefaultDatetimeFormat;

    protected $table = 'broker_users';
}
