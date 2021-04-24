<?php

namespace App\Admin\Controllers;

use App\Models\Account;
use App\Models\AccountStat;
use App\Models\AccountStatus;
use App\Models\CopierType;
use App\Models\Order;
use App\Models\OrderStatus;

use App\Models\Strategy;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;
use KubAT\PhpSimple\HtmlDomParser;

class StrategyController extends AdminController
{

    protected function title() {
        return __('admin.backtests');
    }


    protected function detail($id)
    {
        $show = new Show(Strategy::findOrFail($id));

        $show->id('ID');
        $show->name('Name');
        $show->created_at('Created');
        $show->updated_at('Updated');

        $show->orders('Orders', function ($order) {
            $order->resource('/admin/strategyorders');

            $order->symbol('Symbol');
            $order->type_str('Type')->sortable();
            $order->lots('Lots');
            $order->price('Price');
            $order->stoploss('Stoploss');
            $order->takeprofit('TakPprofit');
            $order->time_open('Time');
            $order->time_close('Closed');
            $order->price_close('PriceClose');
            $order->pl('P/L');
        });

        return $show;
    }

    protected function grid()
    {
        return new Grid( new Strategy(), function (Grid $grid) {
            $grid->model()->whereManagerId(Admin::user()->id);

            $grid->id('ID')->sortable();

            //$grid->account()->title('Portfolio')->sortable();
            $grid->name('Name')->sortable();

            $grid->file_name('File');

            // $grid->orders_count('#Orders')->display(function ($count) {
            //     $count = $count['aggregate'];
            //     return "<span class='label label-warning'>{$count}</span>";
            // });

            //dd($grid->stats());

            $grid->column('stats.drawdown_perc', 'Max DD%');
            $grid->column('stats.nof_closed', '#Orders');
            $grid->column('stats.profit', 'P/L');

            $grid->created_at();
            $grid->updated_at();


            $grid->filter(function ($filter) {
                $filter->like('name');
                $filter->disableIdFilter();
            });

            $grid->rows(function ($row) {
                //print_r($row);
            });
        });
    }

    private function _generateAccount($managerId, $title) {
        $accountNumber = 1;
        while(true) {
            $account = Account::firstOrCreate(
                ['account_number' => $accountNumber],
                [
                    'account_number' => $accountNumber,
                    'password' => $accountNumber,
                    'api_server_ip' => '127.0.0.1',
                    'name' => $title,
                    'title' => $title,
                    'creator_id' => $managerId,
                    'manager_id' => $managerId,
                    'user_id' => $managerId,
                    'copier_type' => CopierType::STRATEGY,
                    'broker_server_name' => 'Tester',
                    'account_status' => AccountStatus::SUSPEND_STOPPED,
                    'trade_allowed' => 0,
                ]
            );

            if($account->wasRecentlyCreated)
                return $account;

            $accountNumber++;
        }

        return false;
    }

    private function _process_html($strategy_id, $title, $data)
    {
        $html = HTMLDomParser::str_get_html($data);

        $topT = $html->find('table', 0);
        $tr = $topT->children(0);
        $symbol = Str::before($tr->children(1)->plaintext, ' (' );

        $dateStartTr = $topT->children(1);
        $dateStart = $dateStartTr->children(1)->plaintext;
        $dateStart = substr($dateStart, strpos($dateStart, '  '), 18);

        $tr = $topT->children(8);
        $deposit = $tr->children(1)->plaintext;

        $tr = $topT->children(9);
        $profit = $tr->children(1)->plaintext;

        $tr = $topT->children(10);
        $winRatio = $tr->children(1)->plaintext;

        $tr = $topT->children(11);
        $max_dd = Str::between($tr->children(3)->plaintext, ' (', '%)' );

        $tr = $topT->children(13);
        $nofClosed = $tr->children(1)->plaintext;

        $tr = $topT->children(14);

        $nofWinning = Str::before($tr->children(2)->plaintext, ' (' );
        $nofLossing = Str::before($tr->children(4)->plaintext,' (' );

        $account = $this->_generateAccount(Admin::user()->id, $title);

        $stat = new AccountStat();

        $stat->account_number = $account->account_number;
        $stat->nof_closed = $nofClosed + 1;
        $stat->nof_winning = $nofWinning;
        $stat->nof_lossing = $nofLossing;
        $stat->win_ratio = $winRatio;
        $stat->profit = $profit;
        $stat->drawdown_perc = $max_dd;

        // $mult = 1;
        // if (empty($accountNumber)) {
        //     $accountNumber = $strategy_id;
        // } else {
        //     $initBalance = Order::where('account_number', $accountNumber)->where('type', 6)->first();
        //     if ($initBalance) {
        //         $initBalance = $initBalance->pl;
        //         $mult = $initBalance/($deposit + $profit);
        //     }
        // }

        $order = new Order();
        $order->status = OrderStatus::CLOSED;
        $order->strategy_id = $strategy_id;
        $order->account_number = $account->account_number;
        $order->ticket = 0;
        $order->time_open = $dateStart;
        $order->type_str = 'Balance';
        $order->type = 6;
        $order->lots = 0;
        $order->symbol = '';
        $order->price = 0;
        $order->stoploss = 0;
        $order->takeprofit = 0;
        $order->time_close = $dateStart;
        $order->price_close = 0;
        $order->commission = 0;
        $order->swap = 0;
        $order->pl = $deposit;
        $order->pips = 0;
        $order->comment = $title;

        $order->save();

        $i = 0 ;
        $totalLots = 0;
        $types = ['buy', 'sell', 'close', 'close at stop', 't/p', 's/l'];
        foreach ($html->find('table', 1)->children() as $ch) {
            if ($i++ < 1) {
                continue;
            }

            $type = $ch->children(2)->plaintext;

            if (in_array($type, $types) == false) {
                continue;
            }

            $id = $ch->children(3)->plaintext;
            $o[$id]['id'] = $id;

            if ($type == 'buy' || $type == 'sell') {
                $o[$id]['time_open'] = $ch->children(1)->plaintext;
                $o[$id]['price'] = $ch->children(5)->plaintext;
                $o[$id]['type'] = $type;
            } else { // type=close

                $timeClose = $ch->children(1)->plaintext;
                $lots = $ch->children(4)->plaintext;
                $priceClose = $ch->children(5)->plaintext;
                $sl = $ch->children(6)->plaintext;
                $tp = $ch->children(7)->plaintext;
                $pl = $ch->children(8)->plaintext;

                $order = new Order();
                $order->status = OrderStatus::CLOSED;
                $order->strategy_id = $strategy_id;
                $order->account_number = $account->account_number;
                $order->ticket = $o[$id]['id'];
                $order->time_open = $o[$id]['time_open'];
                $order->type_str = strtoupper( $o[$id]['type'] );
                $order->type = ($order->type_str == 'BUY' ? 0 : 1);
                $order->lots = $lots;
                $totalLots += $lots;
                $order->symbol = strtoupper($symbol);
                $order->price = $o[$id]['price'];
                $order->stoploss = $sl;
                $order->takeprofit = $tp;
                $order->time_close = $timeClose;
                $order->price_close = (double)($priceClose);
                $order->commission = 0;
                $order->swap = 0;
                $order->pl = (double)($pl);
                $order->comment = $title;

                $t = $order->price;
                $didgits = strlen($t) - (strpos($t, '.') + 1);

                if ($order->type == 0) {
                    $order->pips = ($order->price_close - $order->price)* pow(10, $didgits);
                } else {
                    $order->pips = ($order->price - $order->price_close)* pow(10, $didgits);
                }

                $order->save();
                unset($o[$id]);
            }
        }

        $stat->total_lots = $totalLots;
        $stat->save();

        return $account;
    }

    protected function form()
    {
        return new Form(new Strategy(), function (Form $form) {
            $form->hidden('manager_id')->value(Admin::user()->id);

            $form->display('id', 'ID');

            $options['overwriteInitial'] = true;
            $options['initialPreviewAsData'] = false;
            $form->file('file_name', 'File')->options($options)->rules('required')->hidePreview();

            $form->text('name', 'Title')->required();

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saved(function (Form $form) {
                if($form->file_name) {
                    $account = $this->_process_html($form->model()->id, $form->model()->name, $form->file_name->get());
                    $form->model()->account_id = $account->id;
                    $form->model()->save();
                }
            });

            $form->disableCreatingCheck();
            $form->disableEditingCheck();
            $form->disableViewCheck();
            $form->disableReset();
        });
    }
}
