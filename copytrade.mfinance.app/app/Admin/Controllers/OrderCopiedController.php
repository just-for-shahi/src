<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\OrderStatusGridExt;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\CopierType;

use App\Models\Order;
use App\Models\OrderStatus;
use App\User;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\Request;

class OrderCopiedController extends Controller
{

    public function index()
    {
        $url = Request::fullUrlWithQuery(['master_ticket' => '_master_ticket_']);
        $script = "
        $('.label-master-ticket').click(function () {

            var url = \"$url\".replace('_master_ticket_', $(this).html());

            $.pjax({container:'#pjax-container', url: url });

        });";
        //SCRIPT;

        Admin::script($script, true);
        //Admin::js($js);
        return new Content(function (Content $content) {
            $content->header('Copied Orders');
            $content->description('Manage Copied Orders');

            $content->row(function ($row) {
                $row->column(6, $this->gridMaster());
                $row->column(6, $this->gridSlave());
            });
        });
    }

    protected function gridMaster()
    {
        return new Grid(new Order(), function (Grid $grid) {
            $masterTicket = Request::get('master_ticket');

            $def = null;
            $accounts = Account
                ::whereManagerId(User::GetManagerId())
                ->where('copier_type', CopierType::MASTER)
                ->selectRaw("CONCAT (`account_number`,
                    CASE WHEN title IS NULL THEN '' ELSE CONCAT(' (',`title`,')', '-',api_version) END  ) AS acc_title, account_number")
                ->pluck('acc_title', 'account_number');

            if (count($accounts) > 0) {
                $def = $accounts->keys()->first();
            }

            if (Request::get('account_number') == '') {
                $grid->model()
                    ->where(['account_number' => $def, 'status' => OrderStatus::OPEN])
                    ->whereIn('type', [0, 1])
                    ->orderBy('status', 'ASC')->orderBy('time_open', 'DESC');
                    //->limit(20);
            } else {
                $grid->model()
                ->whereIn('type', [0, 1])
                ->orderBy('status', 'ASC')
                ->orderBy('time_open', 'DESC');
                //->limit(20);
            }

            $grid->symbol('Symbol');
            $grid->type_str('Type');
            $grid->lots('Lots');
            $grid->price('Price');
            $grid->stoploss('SL');
            $grid->takeprofit('TP');
            $grid->time_open('Time');
            $grid->magic('Magic');
            $grid->countCopiedOpen('O');
            $grid->countCopiedClosed('C');
            $grid->countCopiedNotFilled('NF');
            $grid->column('_ticket', 'View Copied ->');

            $grid->filter(function ($filter) use ($accounts, $def) {
                $filter->expand();
                $filter->equal('account_number', 'Master Account')->select($accounts)->default($def);
                $filter->equal('status', 'Order Status')->select([
                    OrderStatus::OPEN => OrderStatus::title(OrderStatus::OPEN),
                    OrderStatus::CLOSED => OrderStatus::title(OrderStatus::CLOSED),
                ])->default(OrderStatus::OPEN);
                $filter->disableIdFilter();
            });
            $grid->rows(function ($row) use ($masterTicket) {
                $row->column(
                    '_ticket',
                    "<span class='label label-master-ticket btn btn-info submit btn-sm'>{$row->ticket}</span>"
                );
                if ($row->ticket == $masterTicket) {
                    $row->style('background:#00c0ef');
                }
            });
            //$grid->accountStat()->balance('Balance');
            $grid->disableTools();
            $grid->disableCreateButton();
            $grid->disableExport();
            $grid->disableActions();
            $grid->disablePagination();
            $grid->disableRowSelector();
        });
    }

    protected function gridSlave()
    {
        return new Grid(new Order(), function (Grid $grid) {
            $master_ticket = Request::get('master_ticket');
            $orderStatus = Request::get('order_status');
            if ($orderStatus == '') {
                $orderStatus = OrderStatus::OPEN;
            }
            $grid->model()->whereMagic($master_ticket)->whereStatus($orderStatus)->orderBy('status', 'ASC')->orderBy('time_close', 'DESC');
            //$grid->status('Status')->display(function($status) { return OrderStatus::title ($status); })->sortable();
            $grid->account_number('Account');
            //$grid->accountBalance('Balance');
            if ((int) $orderStatus === OrderStatus::NOT_FILLED) {
                $grid->accountBalance('Balance');
                $grid->last_error('Last Error');
            } else {
                $grid->ticket('Ticket');
                $grid->symbol('Symbol');
                $grid->type_str('Type');
                $grid->lots('Lots');
                $grid->price('Price');
                $grid->stoploss('SL');
                $grid->takeprofit('TP');
                $grid->time_open('Time');
                //$grid->time_open('Time');
                //$grid->time_close('Closed');
                //$grid->pl('P/L');
            }

            $grid->tools(function ($tools) {
                $tools->append(new OrderStatusGridExt());
            });

            $grid->disableFilter();
            $grid->disableCreateButton();
            $grid->disableExport();
            $grid->disableActions();
            //            $grid->disableBatchDeletion();
        });
    }
}
