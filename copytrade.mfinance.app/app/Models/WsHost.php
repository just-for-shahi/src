<?php

namespace App\Models;

use App\User;
use App\Models\Account;
use Illuminate\Database\Eloquent\Model;

class WsHost extends Model
{
    protected $table = 'ws_hosts';

    public function accounts()
    {
        return $this->hasMany(Account::class, 'ws_host', 'host');
    }

    public function manager() {
        return $this->belongsTo(User::class);
    }
}
