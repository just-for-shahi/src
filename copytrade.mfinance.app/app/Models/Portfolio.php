<?php

namespace App\Models;

use App\Models\Account;
use App\Models\AccountStat;
use App\Models\CopierType;
use App\Models\PortfolioStat;
use App\User;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use DefaultDatetimeFormat;

    private $cached = false;
    private $drawdown = 0;
    private $nofOrders = 0;
    private $profit = 0;
    private $totalLots = 0;
    private $balance = 0;

    protected $appends = [
        'drawdown',
        'countOrders',
        'profit',
        'totalLots',
        'balance'
    ];

    protected $table = 'portfolios';

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function stat()
    {
        return $this->hasOne(PortfolioStat::class);
    }

    public function accounts()
    {
        return $this->belongsToMany(Account::class, 'portfolio_accounts', 'portfolio_id', 'account_id');
    }

    public function getTotalLotsAttribute()
    {

        $this->_calcStat();

        return $this->totalLots;
    }

    public function getBalanceAttribute()
    {

        $this->_calcStat();

        return $this->last_balance + $this->balance;
    }

    public function getDrawdownAttribute()
    {

        $this->_calcStat();

        return $this->drawdown;
    }

    public function getCountOrdersAttribute()
    {
        $this->_calcStat();

        return $this->nofOrders;
    }

    public function getProfitAttribute()
    {
        $this->_calcStat();

        return $this->profit;
    }

    private function _calcStat() {

        if($this->cached)
            return;

        $dd = array();
        $accounts = $this->accounts()->get();

        if($accounts->count() < 1) {
            $this->cached = true;
            return 0;
        }

        foreach($accounts as $account) {

            if($account->copier_type != CopierType::STRATEGY)
                AccountStat::calcAdvStat($account->account_number);

            $stat = $account->stat()->first();

            if(!$stat)
                continue;

            $this->nofOrders += $stat->nof_closed;
            $this->profit += $stat->profit;
            $this->totalLots += $stat->total_lots;
            $this->balance += $stat->balance;

            $d = $stat->drawdown_perc;
            if($d && !is_null($d))
                $dd[] = $account->stat()->first()->drawdown_perc;
        }

        if(count($dd) > 0) {
            $this->drawdown = max($dd);
        }

        $this->cached = true;
    }

}
