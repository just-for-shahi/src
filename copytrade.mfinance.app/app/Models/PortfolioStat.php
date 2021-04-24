<?php

namespace App\Models;

use App\Models\Portfolio;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PortfolioStat extends Model
{
    protected $table = 'portfolio_stat';
    protected $primaryKey = 'portfolio_id';

    public static function listHasNewOrder() {
        $q = "SELECT nof_closed, portfolio_accounts.`portfolio_id`, COUNT(ticket) AS curr
        FROM portfolio_accounts
        INNER JOIN accounts
        ON portfolio_accounts.`account_id`=accounts.`id`
        INNER JOIN account_orders
        ON accounts.account_number=account_orders.`account_number`
        AND ( account_orders.`type` = 0 OR account_orders.`type` = 1 )
        LEFT JOIN portfolio_stat
        ON portfolio_stat.`portfolio_id`=portfolio_accounts.`portfolio_id`
        GROUP BY portfolio_accounts.`portfolio_id`";

        $items = DB::select($q);
        //echo $q;

        $data = array();
        foreach($items as $item ) {
            if( is_null( $item->nof_closed) || $item->nof_closed < $item->curr ) {
                $data[] = $item->portfolio_id;
            }
        }

        return $data;
    }

    public static function calcAdvStat($portfolioId) {
        $accountNumbers = Portfolio::find($portfolioId)->accounts()->pluck('account_number')->toArray();

        if(count($accountNumbers) > 0)
            $s = implode(',', $accountNumbers);
        else
            return;

        $q = "insert ignore into portfolio_stat (portfolio_id) values ({$portfolioId})";
        DB::statement($q);

        $q = "update portfolio_stat set nof_closed=(SELECT count(ticket) FROM `account_orders` WHERE account_number in ($s) and type !=6 and status=3 ) WHERE portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set total_commission=".
	        "IFNULL((SELECT sum(pl) FROM account_orders WHERE type=6 and status=3 and ( comment like 'Commission - %' or comment like '%Rollover%' ) and account_number in ($s)), 0)".
		    "+(SELECT sum(commission) FROM `account_orders` WHERE (type=1 or type=0) and status=3 and account_number in ($s)) where portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set net_profit=total_commission+(SELECT sum(pl+swap) FROM `account_orders` WHERE (type=1 or type=0) and status=3 and account_number in ($s)) where  portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set deposit=(select initial_deposit from portfolios where id={$portfolioId})";
        DB::statement($q);

        $q = "update portfolio_stat SET net_pl = case when deposit=0 then 0 else net_profit/(deposit)*100 end where  portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set nof_winning=(SELECT count(ticket) FROM `account_orders` WHERE account_number in ($s) and pl>=0 and (type=0 or type=1) and status=3) ,
            nof_lossing=(SELECT count(ticket) FROM `account_orders` WHERE account_number in ($s) and pl<0 and (type=0 or type=1) and status=3) where  portfolio_id={$portfolioId}";
        DB::statement($q);

	    $q = "SELECT m1.pl, m1.time_open, (select sum(m2.pl) from account_orders m2 where m2.time_close < m1.time_open and m2.account_number in ($s) and (type=0 or type=1 or type=6) and status=3) as s FROM `account_orders` m1 WHERE account_number in ($s) and (type=0 or type=1) and status=3";
	    $items = DB::select($q);

	    $d = 1;
	    foreach ($items as $item) {
	      if($item->s != 0)
	      	$d *= ($item->pl/$item->s+1);
	    }
        $d =  number_format(($d-1)*100,2, '.','');
//        dd($d);

        $q = "select initial_deposit as pl, deposited_at AS time_close from portfolios where id={$portfolioId}".
        " UNION ALL ".
        "SELECT pl, time_close FROM `account_orders` ".
            " WHERE account_number in ($s) and status=3 and (type=0 or type=1) order by time_close";
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

        $q = "update portfolio_stat set drawdown_perc='$dd', gain_perc='$d', highest_dol=$max, highest_date=$date_max where  portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set total_days=(SELECT CASE WHEN FLOOR(DATEDIFF(max(time_close), min(time_open))) = 0 THEN 1 ELSE FLOOR(DATEDIFF(max(time_close), min(time_open))) END  FROM `account_orders` WHERE (type=0 or type=1) and status=3 and account_number in ($s)) where  portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat SET avg_daily_return = gain_perc/(total_days) where  portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set total_months=(SELECT
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
        ) FROM `account_orders` WHERE (type=0 or type=1) and status=3 and account_number in ($s)) where portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set total_months=1 where portfolio_id={$portfolioId} and total_months=0";
        DB::statement($q);

        $q = "update portfolio_stat SET monthly_perc = gain_perc/(total_months) where portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set interest=(SELECT IFNULL(sum(swap),0) FROM `account_orders` WHERE (type=1 or type=0) and status=3 and account_number in ($s)) where portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set withdrawal=(SELECT sum(pl) FROM `account_orders` WHERE type=7 and account_number in ($s) and status=3) where portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set net_profit_pips=(SELECT sum(pips) FROM `account_orders` WHERE (type=1 or type=0)  and status=3 and account_number in ($s))  where portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set avg_win_pips=(SELECT avg(pips) FROM `account_orders` WHERE (type=0 or type=1) and pl>=0 and status=3 and account_number in ($s)) where portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set avg_win=(SELECT avg(pl) FROM `account_orders` WHERE (type=0 or type=1) and pl>=0 and status=3 and account_number in ($s)) where portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set avg_loss=(SELECT avg(pl) FROM `account_orders` WHERE (type=0 or type=1) and pl<0 and status=3 and account_number in ($s)) where portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set avg_loss_pips=(SELECT avg(pips) FROM `account_orders` WHERE (type=0 or type=1) and pl<0 and status=3 and account_number in ($s)) where portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set total_lots=(SELECT sum(lots) FROM `account_orders` WHERE (type=1 or type=0) and status=3 and account_number in ($s)) where portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set total_longs=(SELECT count(ticket) FROM `account_orders` WHERE (type=0) and status=3 and account_number in ($s)) where portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set longs_won=(SELECT count(ticket) FROM `account_orders` WHERE (type=0) and pl>=0 and status=3 and account_number in ($s)) where portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set total_shorts=(SELECT count(ticket) FROM `account_orders` WHERE (type=1) and status=3 and account_number in ($s)) where portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set shorts_won=(SELECT count(ticket) FROM `account_orders` WHERE (type=1) and pl>=0 and status=3 and account_number in ($s)) where portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set best_trade_dol=(SELECT max(pl) FROM `account_orders` WHERE type!=6 and account_number in ($s) and status=3) where portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set worst_trade_dol=(SELECT min(pl) FROM `account_orders` WHERE type!=6 and account_number in ($s) and status=3) where portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set best_trade_pips=(SELECT max(pips) FROM `account_orders` WHERE type!=6 and account_number in ($s) and status=3) where portfolio_id={$portfolioId}";
        DB::statement($q);

        $q = "update portfolio_stat set worst_trade_pips=(SELECT min(pips) FROM `account_orders` WHERE type!=6 and account_number in ($s) and status=3) where portfolio_id={$portfolioId}";
        DB::statement($q);
    }

    public function calcStat()
    {
        $accountNumbers = $this->portolio()->accounts()->pluck('account_number')->toArray();

        if(count($accountNumbers) < 1)
            return;

        $orders = Order::whereIn('account_number',$accountNumbers)->marketClosed()->orderBy('time_close', 'ASC')
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

}
