<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountStat;
use App\Models\PortfolioStat;
use App\Models\Order;
use App\Models\Portfolio;
use App\User;
use DB;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public function add_trusted(Request $request)
    {

        try {
            $remoteHost = $request->getHost();
            $manager = $request->user();
            $existingHosts = $manager->trusted_hosts;

            if(!$existingHosts || !in_array($remoteHost, $existingHosts))
                $existingHosts[] = $remoteHost;

            $manager->trusted_hosts = $existingHosts;
            $manager->save();

            return response()->json(['success' => true,
                'message' => "Successfully authorized. Domain: '$remoteHost' is added to trusted hosts."]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

    }

    public function check_trusted(Request $request)
    {

        try {
            $remoteHost = $request->getHost();

            $manager = User::whereJsonContains('trusted_hosts', $remoteHost)->first();

            if($manager) {
                return response()->json(['success' => true,
                    'message' => "Domain: '$remoteHost' is connected to manager '{$manager->username}'."]);
            }

            return response()->json(['success' => false,
                'message' => "Domain: '$remoteHost' is not connected to any manager."]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

    }

    public function list_accounts(Request $request)
    {

        try {
            $remoteHost = $request->getHost();

            $manager = User::whereJsonContains('trusted_hosts', $remoteHost)->first();

            if($manager == false) {
                return response()->json(['success' => false,
                'message' => "Domain: '$remoteHost' is not connected to any manager."]);
            }

            $accounts = Account::whereManagerId($manager->id)->get(['account_number','name', 'broker_server_name']);

            return response()->json(['success' => true,'message' => 'success', 'items' => $accounts]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

    }

    public function listPortfolios(Request $request)
    {

        try {

            $portfolios = Portfolio::whereManagerId($request->user()->id)->get();

            return response()->json(['success' => true,'message' => 'success', 'items' => $portfolios]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

    }


    public function equity(Request $request, int $accountNumber) {

        try {

            $account = Account
                ::where('account_number', $accountNumber)
                ->whereManagerId($request->user()->id)->first();

            if($account == false) {
                return response()->json(['success' => false,
                'message' => 'account does not exists']);
            }

            $orders = Order
                ::where('account_number', $accountNumber)
                ->whereNotNull('time_close')
                ->where( function($query) {
                    $query
                        ->orWhere('type',0)
                        ->orWhere('type', 1)
                        ->orWhere('type',6);
                } )
                ->where('status', 3)
                ->orderBy('time_close')
                ->get(['pl', 'time_close']);

            // $query = "select pl, pips, time_close from {$db->account_orders} where account_number=$account_number and (type=0 or type=1 or type=6) and status=3 ".
            // " $filter and time_close is not null order by time_close ".$limit;
            //echo $query;
            //exit();

            $items = array();
            $pl = 0;
            foreach ($orders as $order) {
                $pl += $order->pl;
                $time = strtotime($order->time_close) * 1000;
                $items[$time] = number_format($pl, 2, '.', '' );
            }

            return response()->json(['success' => true, 'message' => 'Success', 'items'=>$items]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

    }

    public function equityPortfolio(Request $request, int $portfolioId) {

        try {

            $portfolio = Portfolio::find($portfolioId);

            if(!$portfolio || $portfolio->manager_id != $request->user()->id) {
                return response()->json(['success' => false, 'message' => 'Porfolio not found or does not belongs to you']);
            }

            $accountNumbers = $portfolio->accounts()->pluck('account_number')->toArray();

            $orders = Order
                ::whereIn('account_number', $accountNumbers)
                ->whereNotNull('time_close')
                ->where( function($query) {
                    $query
                        ->orWhere('type',0)
                        ->orWhere('type', 1);
                        //->orWhere('type',6);
                } )
                ->where('status', 3)
                ->orderBy('time_close')
                ->get(['pl', 'time_close']);

            $items = array();
            $pl = $portfolio->initial_deposit;

            $time = strtotime($portfolio->deposited_at) * 1000;
            $items[$time] = number_format($portfolio->initial_deposit, 2, '.', '' );

            foreach ($orders as $order) {
                $pl += $order->pl;
                $time = strtotime($order->time_close) * 1000;
                $items[$time] = number_format($pl, 2, '.', '' );
            }

            return response()->json(['success' => true, 'message' => 'Success', 'items'=>$items]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

    }


    public function instruments(Request $request, int $accountNumber) {

        try {

            $account = Account
                ::where('account_number', $accountNumber)
                ->whereManagerId($request->user()->id)->first();

            if($account == false) {
                return response()->json(['success' => false,
                'message' => 'account does not exists']);
            }

            $query = "select count(ticket) as pl, symbol from account_orders where status=3 and (type=0 or type=1) ".
            " and account_number='$accountNumber' and right(symbol, 2) != 'bo' GROUP BY symbol";
            //$query = "select round(sum(IFNULL(pl,0)+IFNULL(commission,0)),2) as pl, symbol from {$this->wpdb_mt4->account_orders} where status=3 and (type=0 or type=1) and account_number='$account_number' and right(symbol, 2) != 'bo' GROUP BY symbol";
            //echo $query;
            $data = DB::select($query);

            $items = array();
            $total = 0;
            foreach ($data as $item) {
            if($item->pl > 0) {
                $items[$item->symbol] = $item->pl;
                $total += $item->pl;
            }
            }

            //print_r($items);
            //echo $total;

            foreach ($items as $key => $val) {
            $items[$key] = number_format($val/$total*100,2,'.', '');
            }

            return response()->json(['success' => true, 'message' => 'Success', 'items'=>$items]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

    }

    public function instrumentsPortfolio(Request $request, int $portfolioId) {

        try {

            $portfolio = Portfolio::find($portfolioId);

            if(!$portfolio || $portfolio->manager_id != $request->user()->id) {
                return response()->json(['success' => false, 'message' => 'Porfolio not found or does not belongs to you']);
            }

            $accountNumbers = $portfolio->accounts()->pluck('account_number')->toArray();
            $accountNumbers = implode("','", $accountNumbers);

            $query = "select count(ticket) as pl, symbol from account_orders where status=3 and (type=0 or type=1) ".
            " and account_number in ('$accountNumbers') and right(symbol, 2) != 'bo' GROUP BY symbol";
            //$query = "select round(sum(IFNULL(pl,0)+IFNULL(commission,0)),2) as pl, symbol from {$this->wpdb_mt4->account_orders} where status=3 and (type=0 or type=1) and account_number='$account_number' and right(symbol, 2) != 'bo' GROUP BY symbol";
            //echo $query;
            $data = DB::select($query);

            $items = array();
            $total = 0;
            foreach ($data as $item) {
            if($item->pl > 0) {
                $items[$item->symbol] = $item->pl;
                $total += $item->pl;
            }
            }

            //print_r($items);
            //echo $total;

            foreach ($items as $key => $val) {
            $items[$key] = number_format($val/$total*100,2,'.', '');
            }

            return response()->json(['success' => true, 'message' => 'Success', 'items'=>$items]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

    }



    public function advstat(Request $request, int $accountNumber) {

        try {
            $account = Account
                ::where('account_number', $accountNumber)
                ->whereManagerId($request->user()->id)->first();

            if($account == false) {
                return response()->json(['success' => false,
                'message' => 'account does not exists']);
            }

            AccountStat::calcAdvStat($accountNumber);
            $stat = AccountStat::where('account_number', $accountNumber)->first();

            if($stat == false) {
                return response()->json(['success' => false,
                'message' => 'account does not exists']);
            }

            return response()->json(['success' => true, 'message' => 'Success', 'item'=>$stat]);
        } catch (\Exception $e) {
            throw $e;
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

    }

    public function advstatPortfolio(Request $request, int $portfolioId) {

        try {

            $portfolio = Portfolio::find($portfolioId);

            if(!$portfolio || $portfolio->manager_id != $request->user()->id) {
                return response()->json(['success' => false, 'message' => 'Porfolio not found or does not belongs to you']);
            }

            //PortfolioStat::calcAdvStat($portfolioId);

            $stat = PortfolioStat::find($portfolioId);

            if($stat == false) {
                 return response()->json(['success' => false,
                 'message' => 'Portfolio stat does not exists']);
            }

            return response()->json(['success' => true, 'message' => 'Success', 'item'=>$stat]);
        } catch (\Exception $e) {
            throw $e;
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

    }

    public function history(Request $request, int $accountNumber, int $limit = 10) {

        try {

            $account = Account
                ::where('account_number', $accountNumber)
                ->whereManagerId($request->user()->id)->first();

            if($account == false) {
                return response()->json(['success' => false,
                'message' => 'account does not exists']);
            }

            $items = Order::where('account_number', $accountNumber)
                ->where(function($q) {
                    $q->where('type', 0)
                        ->orWhere('type', 1);
                })
                ->where('status', 3)
                ->orderBy('time_close', 'DESC')
                ->get()->take($limit);

            return response()->json(['success' => true, 'message' => 'Success', 'items'=>$items]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

    }

    public function historyPortfolio(Request $request, int $portfolioId, int $limit = 10) {

        try {

            $portfolio = Portfolio::find($portfolioId);

            if(!$portfolio || $portfolio->manager_id != $request->user()->id) {
                return response()->json(['success' => false, 'message' => 'Porfolio not found or does not belongs to you']);
            }

            $accountNumbers = $portfolio->accounts()->pluck('account_number')->toArray();

            $items = Order::whereIn('account_number', $accountNumbers)
                ->where(function($q) {
                    $q->where('type', 0)
                        ->orWhere('type', 1);
                })
                ->where('status', 3)
                ->orderBy('time_close', 'desc')
                ->get()->take($limit);

            return response()->json(['success' => true, 'message' => 'Success', 'items'=>$items]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

    }

}
