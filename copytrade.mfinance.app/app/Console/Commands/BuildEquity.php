<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Order;

use App\Models\Account;
use App\Models\OrderType;
use App\Models\OrderEquity;
use App\Console\Commands\BaseCommand;

class BuildEquity extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'equity:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'rebuild equity';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $accounts = Account::where('build_equity', 1)->pluck('account_number')->toArray();

            foreach ($accounts as $accountNumber) {
                $orders = Order
                    ::whereAccountNumber($accountNumber)
                    ->countableClosed()
                    ->orderBy('time_close', 'ASC')
                    ->get(['time_close', 'pl', 'pips', 'strategy_id', 'type']);

                $pl = 0;
                $pips = 0;

                OrderEquity::whereAccountNumber($accountNumber)->delete();
                $is_balance_inited = false;

                $items = array();
                foreach ($orders as $order) {
                    if ($order->type == OrderType::BALANCE) {
                        if ($is_balance_inited) {
                            continue;
                        }
                        if (!empty($order->strategy_id)) {
                            $is_balance_inited = true;
                        }
                    }
                    $pl += $order->pl;
                    $pips += $order->pips;

                    $date = Carbon::parse($order->time_close);
                    $date = $date->format('Y-m-d');

                    $items[$date]['pl'] = $pl;
                    $items[$date]['pips'] = $pips;
                }

                foreach ($items as $date => $pl) {
                    OrderEquity::create([
                        'date_at' => $date,
                        'pl' => $pl['pl'],
                        'pips' => $pl['pips'],
                        'account_number' => $accountNumber
                    ]);
                }
            }
        } catch (\Exception $e) {
            $this->critical($e);
        }
    }
}
