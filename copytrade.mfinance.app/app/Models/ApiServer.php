<?php

namespace App\Models;

use App\Models\Account;
use App\User;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class ApiServer extends Model
{

    use DefaultDatetimeFormat;

    protected $table = 'api_servers';

    public function accounts()
    {
        return $this->hasMany(Account::class, 'api_server_ip', 'ip');
    }

    public function scopeEnabled() {
        return $this->where('enabled', 1);
    }

    public function manager() {
        return $this->belongsTo(User::class);
    }
}
