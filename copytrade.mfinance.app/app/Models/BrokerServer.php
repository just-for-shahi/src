<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Account;
use App\Models\UserBrokerServer;
use Encore\Admin\Traits\DefaultDatetimeFormat;

class BrokerServer extends Model
{
    use DefaultDatetimeFormat;

    protected $table = 'broker_servers';

    protected $fillable = [
        'name','gmt_offset', 'group_title', 'pairs','srv_file'
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function userServer()
    {
        return $this->hasOne(UserBrokerServer::class);
    }

    public function scopeManager($query) {
        return $query->where('api_or_manager', BrokerServerType::MANAGER);
    }

    public function scopeApi($query) {
        return $query->where('api_or_manager', BrokerServerType::API);
    }

    public function scopeEnabled($query) {
        return $query->where('enabled', 1);
    }

    public static function deleteByName($name) {
        $brokerServer = BrokerServer::where('name', $name)->first();

        if($brokerServer) {
            File::destroy($brokerServer->pairs_file_id);
            $brokerServer->delete();
        }
    }
}
