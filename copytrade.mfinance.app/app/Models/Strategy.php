<?php

namespace App\Models;

use App\Models\Account;
use App\Models\AccountStat;

use App\Models\Order;
use App\User;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class Strategy extends Model
{

    use DefaultDatetimeFormat;

    protected $table = 'strategies';

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function stats()
    {
        return $this->hasOneThrough(AccountStat::class, Account::class, 'id', 'account_number', 'account_id', 'account_number');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function ordersCount()
    {
        return $this->hasOne(Order::class)
        ->selectRaw('strategy_id, count(ticket) as aggregate')
        ->groupBy('strategy_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Strategy $strategy) {
            $strategy->account()->delete();
        });
    }
}
