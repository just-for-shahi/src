<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BrokerServer;
use App\User;
use DateTimeInterface;
use Encore\Admin\Traits\DefaultDatetimeFormat;

class UserBrokerServer extends Model
{

    use DefaultDatetimeFormat;

    protected $table = 'user_broker_servers';

    protected $fillable = [
        'broker_server_id', 'user_id','enabled'
    ];

    public function broker_server()
    {
        return $this->belongsTo(BrokerServer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeEnabled() {
        return self::where('enabled', 1);
    }
}
