<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class BrokerManager extends Model
{
    use DefaultDatetimeFormat;
    protected $table = 'broker_managers';

    public function scopeEnabled() {
        $this->whereEnabed(1);
    }
}
