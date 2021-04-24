<?php

namespace App\Models;

use App\Models\Account;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\AccountStat
 *
 * @property int $account_number
 * @property int|null $nof_closed
 * @property int|null $nof_winning
 * @property int|null $nof_lossing
 * @property float|null $win_ratio
 * @property float|null $net_pl
 * @property float|null $net_profit
 * @property float|null $gross_profit
 * @property float|null $gross_loss
 * @property float|null $profit_factor
 * @property int|null $weeks
 * @property float|null $worst_trade_dol
 * @property float|null $best_trade_dol
 * @property float|null $worst_trade_pips
 * @property float|null $best_trade_pips
 * @property int|null $nof_working
 * @property float|null $deposit
 * @property float|null $withdrawal
 * @property float|null $net_profit_pips
 * @property int|null $top_nof_closed
 * @property int|null $top_nof_winning
 * @property int|null $top_nof_lossing
 * @property float|null $top_win_ratio
 * @property float|null $top_net_profit
 * @property float|null $top_net_profit_pips
 * @property float|null $avg_win
 * @property float|null $avg_loss
 * @property float|null $avg_win_pips
 * @property float|null $avg_loss_pips
 * @property float|null $total_lots
 * @property float|null $total_commission
 * @property int|null $total_longs
 * @property int|null $total_shorts
 * @property int|null $longs_won
 * @property int|null $shorts_won
 * @property int|null $avg_trade_duration
 * @property int|null $total_days
 * @property float|null $avg_daily_return
 * @property float|null $interest
 * @property float|null $balance
 * @property string|null $currency
 * @property float|null $profit
 * @property float|null $equity
 * @property float|null $credit
 * @property int|null $mem
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $total_months
 * @property int|null $ping_ms
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property string|null $name
 * @property int|null $is_demo
 * @property-read \App\Models\Account $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountStat newModelstatement()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountStat newstatement()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountStat statement()
 * @mixin \Eloquent
 * @property float|null $monthly_perc
 * @property float|null $gain_perc
 * @property float|null $highest_dol
 * @property float|null $drawdown_perc
 * @property string|null $highest_date
 * @method static \Illuminate\Database\Eloquent\Builder|AccountStat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountStat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountStat query()
 */
class AccountStat extends Model
{
    protected $table = 'accounts_stat';

    protected $primaryKey = 'account_number';

    protected $fillable = [
        'balance', 'nof_closed', 'nof_working', 'currency', 'equity', 'profit', 'credit', 'name'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_number', 'account_number');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'account_number', 'account_number');
    }

    public static function calcAdvStat($accountNumber) {
        $q = "update accounts_stat set nof_closed=(SELECT count(ticket) FROM `account_orders` WHERE account_number=$accountNumber and type !=6 and status=3 ) WHERE account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set total_commission=".
	        "IFNULL((SELECT sum(pl) FROM account_orders WHERE type=6 and status=3 and ( comment like 'Commission - %' or comment like '%Rollover%' ) and account_number=$accountNumber), 0)".
		    "+(SELECT sum(commission) FROM `account_orders` WHERE (type=1 or type=0) and status=3 and account_number=$accountNumber) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set net_profit=total_commission+(SELECT sum(pl+swap) FROM `account_orders` WHERE (type=1 or type=0) and status=3 and account_number=$accountNumber) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set deposit=(SELECT sum(pl) FROM `account_orders` WHERE type=6 and comment not like '%Commission%' and comment not like '%Rollover%' and account_number=$accountNumber and status=3) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat SET net_pl = case when deposit=0 then 0 else net_profit/(deposit)*100 end where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set nof_winning=(SELECT count(ticket) FROM `account_orders` WHERE account_number=$accountNumber and pl>=0 and (type=0 or type=1) and status=3) ,
            nof_lossing=(SELECT count(ticket) FROM `account_orders` WHERE account_number=$accountNumber and pl<0 and (type=0 or type=1) and status=3) where account_number=$accountNumber";
        DB::statement($q);

	    $q = "SELECT m1.pl, m1.time_open, (select sum(m2.pl) from account_orders m2 where m2.time_close < m1.time_open and m2.account_number=$accountNumber and (type=0 or type=1 or type=6) and status=3) as s FROM `account_orders` m1 WHERE account_number=$accountNumber and (type=0 or type=1) and status=3";
	    $items = DB::select($q);

	    $d = 1;
	    foreach ($items as $item) {
	      if($item->s != 0)
	      	$d *= ($item->pl/$item->s+1);
	    }
        $d =  number_format(($d-1)*100,2, '.','');
//        dd($d);

	    $q = "SELECT pl, time_close FROM `account_orders` WHERE account_number=$accountNumber and status=3 and (type=0 or type=1 or (type=6 and comment not like '%Commission%' and comment not like '%Rollover%')) order by time_close";
	    $items = DB::select($q);

	    $max = 0;
	    $date_max = 'NULL';
	    $peak = 0;
	    $lowest = 0;
	    $dd = 0;
	    $sum = 0;
	    foreach ($items as $item) {
	      $sum += $item->pl;

	      if($max <= $sum ) {
	        $max = $sum;
	        $date_max = $item->time_close;
	      }

	      if($sum >= $peak) {
	      	$peak = $sum;
	      	$lowest = $sum;
	      }

	      if($sum <= $peak) {
	      	$lowest = $sum;
	      }

          if($lowest != 0) {
	        $t = ($peak-$lowest)/$lowest;
	        if($t > $dd)
              $dd = $t;
          }
	    }

	    $dd =  number_format($dd*100,2, '.','');

        if($date_max != 'NULL')
            $date_max = "'$date_max'";

        $q = "update accounts_stat set drawdown_perc='$dd', gain_perc='$d', highest_dol=$max, highest_date=$date_max where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set total_days=(SELECT CASE WHEN FLOOR(DATEDIFF(max(time_close), min(time_open))) = 0 THEN 1 ELSE FLOOR(DATEDIFF(max(time_close), min(time_open))) END  FROM `account_orders` WHERE (type=0 or type=1) and status=3 and account_number=$accountNumber) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat SET avg_daily_return = gain_perc/(total_days) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set total_months=(SELECT
        TIMESTAMPDIFF(MONTH, min(time_open), max(time_close)) +
        DATEDIFF(
          max(time_close),
          min(time_open) + INTERVAL
            TIMESTAMPDIFF(MONTH, min(time_open), max(time_close))
          MONTH
        ) /
        DATEDIFF(
          min(time_open) + INTERVAL
            TIMESTAMPDIFF(MONTH, min(time_open), max(time_close)) + 1
          MONTH,
          min(time_open) + INTERVAL
            TIMESTAMPDIFF(MONTH, min(time_open), max(time_close))
          MONTH
        ) FROM `account_orders` WHERE (type=0 or type=1) and status=3 and account_number=$accountNumber) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set total_months=1 where account_number=$accountNumber and total_months=0";
        DB::statement($q);

        $q = "update accounts_stat SET monthly_perc = gain_perc/(total_months) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set interest=(SELECT IFNULL(sum(swap),0) FROM `account_orders` WHERE (type=1 or type=0) and status=3 and account_number=$accountNumber) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set withdrawal=(SELECT sum(pl) FROM `account_orders` WHERE type=7 and account_number=$accountNumber and status=3) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set net_profit_pips=(SELECT sum(pips) FROM `account_orders` WHERE (type=1 or type=0)  and status=3 and account_number=$accountNumber)  where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set avg_win_pips=(SELECT avg(pips) FROM `account_orders` WHERE (type=0 or type=1) and pl>=0 and status=3 and account_number=$accountNumber) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set avg_win=(SELECT avg(pl) FROM `account_orders` WHERE (type=0 or type=1) and pl>=0 and status=3 and account_number=$accountNumber) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set avg_loss=(SELECT avg(pl) FROM `account_orders` WHERE (type=0 or type=1) and pl<0 and status=3 and account_number=$accountNumber) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set avg_loss_pips=(SELECT avg(pips) FROM `account_orders` WHERE (type=0 or type=1) and pl<0 and status=3 and account_number=$accountNumber) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set total_lots=(SELECT sum(lots) FROM `account_orders` WHERE (type=1 or type=0) and status=3 and account_number=$accountNumber) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set total_longs=(SELECT count(ticket) FROM `account_orders` WHERE (type=0) and status=3 and account_number=$accountNumber) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set longs_won=(SELECT count(ticket) FROM `account_orders` WHERE (type=0) and pl>=0 and status=3 and account_number=$accountNumber) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set total_shorts=(SELECT count(ticket) FROM `account_orders` WHERE (type=1) and status=3 and account_number=$accountNumber) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set shorts_won=(SELECT count(ticket) FROM `account_orders` WHERE (type=1) and pl>=0 and status=3 and account_number=$accountNumber) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set best_trade_dol=(SELECT max(pl) FROM `account_orders` WHERE type!=6 and account_number=$accountNumber and status=3) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set worst_trade_dol=(SELECT min(pl) FROM `account_orders` WHERE type!=6 and account_number=$accountNumber and status=3) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set best_trade_pips=(SELECT max(pips) FROM `account_orders` WHERE type!=6 and account_number=$accountNumber and status=3) where account_number=$accountNumber";
        DB::statement($q);

        $q = "update accounts_stat set worst_trade_pips=(SELECT min(pips) FROM `account_orders` WHERE type!=6 and account_number=$accountNumber and status=3) where account_number=$accountNumber";
        DB::statement($q);

    }

    /**
     * @param $accountNumber
     * @return \stdClass
     */
    public static function calcStat($accountNumber)
    {
        $orders = Order::whereAccountNumber($accountNumber)->marketClosed()->orderBy('time_close', 'ASC')
            ->get(['pl', 'pips', 'time_close', 'time_open', 'commission']);

        $info = new \stdClass();
        $total_pips = 0;
        $total_pl = 0;
        $total_time = 0;
        $total_sec = 0;
        $total_min = 0;

        $wins = 0;
        $win_pl = 0;

        $losses = 0;
        $loss_pl = 0;
        foreach ($orders as $order) {
            $pl = $order->pl + $order->commission;
            $total_pl += $pl;
            $total_pips += $order->pips;

            $open = strtotime($order->time_open);
            $close = strtotime($order->time_close);

            $diff = $close - $open;
            $total_time += $diff;

            if ($pl > 0) {
                ++$wins;
                $win_pl += $pl;
            }

            if ($pl < 0) {
                ++$losses;
                $loss_pl += $pl;
            }
        }

        $info->count = count($orders);
        $info->win_loss = 0;
        $info->win_ratio = 0;

        if ($losses != 0) {
            $avg_loss_pl = round($loss_pl/$losses);
        } else {
            $avg_loss_pl = 0;
        }

        if ($wins != 0) {
            $avg_win_pl = round($win_pl/$wins);
        } else {
            $avg_win_pl = 0;
        }

        if ($info->count != 0) {
            $info->win_ratio = number_format($wins/$info->count*100, 0, '.', '');
        }

        if ($avg_loss_pl != 0) {
            $info->win_loss = abs(number_format($avg_win_pl/$avg_loss_pl, 2, '.', ''));
        }

        $info->total_pips = round($total_pips, 2);
        $info->total_pl = round($total_pl);

        if ($total_time != 0) {
            $total_hour = floor($total_time/60/60);
            $total_min = floor($total_time - $total_hour*60*60)/60;
            $total_sec = $total_time - $total_min*60 - $total_hour*60*60;

            $info->total_time = sprintf('%02d:%02d', $total_hour, $total_min);
        } else {
            $info->total_time = 0;
        }

        if ($info->count != 0) {
            $info->avg_pips = round($total_pips/$info->count);
        } else {
            $info->avg_pips = 0;
        }

        return $info;
    }

    public static function calcWeekly($accountNumber)
    {
        $orders = Order::whereAccountNumber($accountNumber)->marketClosed()
            ->select(
                DB::raw(
                    'date(DATE_ADD( time_open, INTERVAL(-WEEKDAY(time_open)) DAY)) monday, '.
                    ' pl, pips, time_close, commission'
                )
            )
            ->orderBy('time_close', 'ASC')
            ->get();

        $mondays = array();
        foreach ($orders as $order) {
            $pl = $order->pl + $order->commission;

            if (isset($mondays[$order->monday])) {
                $mondays[$order->monday]['trades'] += 1;
                $mondays[$order->monday]['pips'] += $order->pips;
                $mondays[$order->monday]['pl'] += $pl;

                if ($order->pl > 0) {
                    $mondays[$order->monday]['wins'] += 1;
                    $mondays[$order->monday]['win_pl'] += $pl;
                }

                if ($order->pl < 0) {
                    $mondays[$order->monday]['losses'] += 1;
                    $mondays[$order->monday]['loss_pl'] += $pl;
                }

                if ($order->pl == 0) {
                    $mondays[$order->monday]['be'] += 1;
                }
            } else {
                if ($order->pl > 0) {
                    $mondays[$order->monday]['wins'] = 1;
                    $mondays[$order->monday]['losses'] = 0;
                    $mondays[$order->monday]['win_pl'] = $pl;
                    $mondays[$order->monday]['loss_pl'] = 0;
                }
                if ($order->pl < 0) {
                    $mondays[$order->monday]['losses'] = 1;
                    $mondays[$order->monday]['wins'] = 0;
                    $mondays[$order->monday]['win_pl'] = 0;
                    $mondays[$order->monday]['loss_pl'] = $pl;
                }

                if ($order->pl == 0) {
                    $mondays[$order->monday]['be'] = 1;
                } else {
                    $mondays[$order->monday]['be'] = 0;
                }

                $mondays[$order->monday]['pl'] = $order->pl + $order->commission;
                $mondays[$order->monday]['trades'] = 1;
                $mondays[$order->monday]['pips'] = $order->pips;
            }
        }

        foreach ($mondays as $day => $monday) {
            $mondays[$day]['avg_pips'] = number_format($monday['pips']/$monday['trades'], 2, '.', '');
            $mondays[$day]['win_ratio'] = number_format($monday['wins']/$monday['trades']*100, 0, '.', '');

            if ($mondays[$day]['losses'] != 0) {
                $mondays[$day]['avg_loss_pl'] = round($mondays[$day]['loss_pl']/$mondays[$day]['losses']);
            } else {
                $mondays[$day]['avg_loss_pl'] = 0;
            }

            if ($mondays[$day]['wins'] != 0) {
                $mondays[$day]['avg_win_pl'] = round($mondays[$day]['win_pl']/$mondays[$day]['wins']);
            } else {
                $mondays[$day]['avg_win_pl'] = 0;
            }

            $mondays[$day]['pl'] = round($mondays[$day]['pl']);

            $mondays[$day]['win_pl'] = round($mondays[$day]['win_pl'], 2);
            $mondays[$day]['loss_pl'] = round($mondays[$day]['loss_pl'], 2);

            if ($mondays[$day]['avg_loss_pl'] != 0) {
                $mondays[$day]['win_loss'] = number_format(
                    $mondays[$day]['avg_win_pl']/$mondays[$day]['avg_loss_pl'],
                    2,
                    '.',
                    ''
                );
            } else {
                $mondays[$day]['win_loss'] = 0;
            }
        }

        return $mondays;
    }
}
