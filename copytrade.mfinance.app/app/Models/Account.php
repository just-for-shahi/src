<?php

namespace App\Models;

use App\Models\AccountStat;
use App\Models\ApiServer;
use App\Models\BrokerServer;
use App\Models\CopierSubscription;
use App\Models\Order;
use App\Models\OrderType;
use App\User;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use DefaultDatetimeFormat;

    protected $table = 'accounts';

    protected $fillable = [
        'account_number', 'broker_server_name', 'password', 'api_server_ip', 'creator_id',
        'user_id', 'manager_id', 'account_status', 'title', 'copier_type'
    ];

    protected $appends = [
        'countLives',
        'countLiveBuys',
        'countLiveSells'
    ];

    public function getFullAccountNameAttribute()
    {
        return $this->account_number . ' (' . $this->title . ')';
    }

    public function stat()
    {
        return $this->hasOne(AccountStat::class, 'account_number', 'account_number');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function api_server()
    {
        return $this->belongsTo(ApiServer::class, 'api_server_ip', 'ip');
    }

    public function broker_server()
    {
        return $this->belongsTo(BrokerServer::class, 'broker_server_name', 'name');
    }

    public function sources()
    {
        return $this->belongsToMany(
            CopierSubscription::class,
            'copier_subscription_source_accounts',
            'account_id',
            'copier_subscription_id'
        );
    }

    public function destinations()
    {
        return $this->belongsToMany(
            CopierSubscription::class,
            'copier_subscription_dest_accounts',
            'account_id',
            'copier_subscription_id'
        );
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'account_number', 'account_number');
    }

    public function liveorders()
    {
        return $this->hasMany(Order::class, 'account_number', 'account_number')->whereIn('status',[1,2]);
    }

    public function closedorders()
    {
        return $this->hasMany(Order::class, 'account_number', 'account_number')->where('status',3);
    }

    public function getCountLiveBuysAttribute() {
        return $this->orders()->whereType(OrderType::BUY)->whereIn('status', [1,2])->count();
    }

    public function getCountLiveSellsAttribute() {
        return $this->orders()->whereType(OrderType::SELL)->whereIn('status', [1,2])->count();
    }

    public function getCountLivesAttribute() {
        return $this->orders()->whereIn('status', [1,2])->count();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->jfx_mode = config('copier.jfx_mode');
            $query->memc_mode = config('copier.memc_mode');
        });
    }

    public function getConnectingQueueName()
    {
        if(config('copier.api_single_thread')) {
            return 'accounts';
        }

        return $this->api_server_ip;
    }

    public function getRemovingQueueName()
    {
        return 'removing';
    }

}
