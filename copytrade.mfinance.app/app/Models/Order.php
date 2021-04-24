<?php

namespace App\Models;

use App\Models\Account;
use App\Models\AccountStat;
use App\Models\CopierType;
use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $table = 'account_orders';

    protected $appends = [
        'countCopiedClosed',
        'countCopiedOpen',
        'countCopiedNotFilled',
    ];

    protected $primaryKey = 'ticket';

    protected $fillable = [
        'ticket','account_number', 'status', 'type', 'type_str', 'pl', 'pips', 'stoploss', 'takeprofit',
        'swap', 'commission', 'symbol', 'lots', 'price_close', 'time_close', 'price', 'time_open',
        'magic', 'last_error_code', 'last_error', 'comment'
    ];

    public function account_stat()
    {
        return $this->hasOneThrough(AccountStat::class, Account::class, 'account_number', 'account_number', 'account_number', 'account_number');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_number', 'account_number');
    }

    public function scopeMarketClosed()
    {
        return $this->market()->closed();
    }

    public function scopeMarket()
    {
        return $this->whereIn('type', OrderType::marketTypes());
    }

    public function scopeCountableClosed()
    {
        return $this->countable()->closed();
    }

    public function scopeCountable()
    {
        return $this->whereIn('type', OrderType::countableTypes());
    }

    public function scopeClosed()
    {
        return $this->whereStatus(OrderStatus::CLOSED);
    }

    public function getCountCopiedClosedAttribute() {

        return DB::table($this->table)
            ->selectRaw('count(ticket) as cnt')
            ->where('magic', $this->ticket)
            ->whereStatus(OrderStatus::CLOSED)
            ->value('cnt');
    }

    public function getCountCopiedOpenAttribute() {

        return DB::table($this->table)
            ->selectRaw('count(ticket) as cnt')
            ->where('magic', $this->ticket)
            ->whereStatus(OrderStatus::OPEN)
            ->value('cnt');
    }

    public function getCountCopiedNotFilledAttribute() {

        return DB::table($this->table)
            ->selectRaw('count(ticket) as cnt')
            ->where('magic', $this->ticket)
            ->whereStatus(OrderStatus::NOT_FILLED)
            ->value('cnt');
    }
}
