<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class BrokerGroup extends Model
{

    use DefaultDatetimeFormat;

    protected $table = 'broker_groups';
}
