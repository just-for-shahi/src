<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccountStat;
use App\Models\OrderEquity;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Jxlwqq\DataTable\DataTable;
use Encore\Admin\Widgets\InfoBox;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return Admin::content(static function (Content $content) {
            $content->header(__('reports.statistics'));
            $content->description(__('reports.account_statistics'));

            $accountId = 12914605;

            $adv = AccountStat::calcAdvanced($accountId);
            /*            $content->row(function ($row) use ($stat) {
                            $row->column(2, new InfoBox('Orders', 'book', 'aqua', '#orders', $stat->nof_closed));
                            $row->column(2, new InfoBox('Balance', 'book', 'aqua', '#', $stat->balance));
                            $row->column(2, new InfoBox('Win', 'book', 'green', '#', $stat->nof_winning));
                            $row->column(2, new InfoBox('Loss', 'book', 'red', '#', $stat->nof_lossing));
                            $row->column(2, new InfoBox('WinRatio', 'book', 'aqua', '#', $stat->win_ratio));
                            $row->column(2, new InfoBox('Gross Profit', 'book', 'aqua', '#', $stat->gross_profit));
                        }); */

            $content->row(static function (Row $row) use ($adv) {
                $row->column(2, new InfoBox(__('reports.orders'), 'book', 'aqua', '#', $adv->count));
                $row->column(2, new InfoBox(__('reports.pl'), 'book', 'aqua', '#', $adv->total_pl));
                $row->column(2, new InfoBox(__('reports.pips'), 'book', 'aqua', '#', $adv->total_pips));
                $row->column(2, new InfoBox(__('reports.win_loss'), 'book', 'aqua', '#', $adv->win_loss));
                $row->column(2, new InfoBox(__('reports.avg_pips'), 'book', 'aqua', '#', $adv->avg_pips));
            });

            $headers = [__('reports.monday'), __('reports.orders'), __('reports.win_loss'), __('reports.ratio'), __('reports.profit_loss')];

            $weekly = AccountStat::calcWeekly($accountId);
            $weeklyData = array();
            foreach ($weekly as $day => $datData) {
                $item = array();

                $item[] = $day;
                $item[] = $datData['trades'];
                $item[] = $datData['win_loss'];
                $item[] = $datData['win_ratio'];
                $item[] = $datData['pl'];

                $weeklyData[] = $item;
            }
            $style = ['table-hover', 'table-striped'];
            $options = [
                'paging' => false,
                'lengthChange' => false,
                'searching' => false,
                'ordering' => false,
                'info' => false,
                'autoWidth' => true,
                'scrollY' => 300,
            ];

            $tableWeekly = new DataTable($headers, $weeklyData, $style, $options);

            $content->row(static function (Row $row) use ($tableWeekly) {
                $row->column(10, (new Box(__('reports.weekly'), $tableWeekly))->style('info')->solid());
            });

            $chartEquity = ReportController::buildEquityChart($accountId);

            $content->row(static function (Row $row) use ($chartEquity) {
                $row->column(10, (new Box(__('reports.equity'), ReportController::displayChart('equity', $chartEquity)))->style('info')->solid());
            });

            $chartPair = ReportController::buildPairsChart($accountId);

            $content->row(static function (Row $row) use ($chartPair) {
                $row->column(10, (new Box(__('reports.markets'), ReportController::displayChart('pairs', $chartPair)))->style('info')->solid());
            });
        });
    }

    /**
     * @param $accountNumber
     * @return \Chart
     */
    private static function buildEquityChart($accountNumber)
    {
        $items = OrderEquity::whereAccountNumber($accountNumber);
        $dataPL = array();
        $dataPips = array();
        foreach ($items as $item) {
            $dataPL[] =  array(strtotime($item->date_at) * 1000, $item->pl);
            $dataPips[] =  array(strtotime($item->date_at) * 1000, $item->pips);
        }

        return \Chart::title([
            false
        ])
            ->subtitle([
                false
            ])
            ->chart([
                'type'     => 'line',
                'renderTo' => 'equity',
            ])
            ->credits([
                'enabled' => false
            ])
            ->xAxis([
                'type' => 'datetime'
            ])
            ->yAxis([
                'title' => [
                    'text' => '%',
                ]
            ])
            ->plotOptions([])
            ->series([
                [
                    'name' => 'P/L',
                    'data' => $dataPL
                ],
                [
                    'name' => 'Pips',
                    'data' => $dataPips
                ]
            ]);
    }

    /**
     * @param $accountNumber
     * @return \Chart
     */
    private static function buildPairsChart($accountNumber)
    {
        $items = Order::whereAccountNumber($accountNumber)
            ->select(DB::raw('symbol, sum(pl) as pl'))
            ->whereNotNull('symbol')
            ->where('symbol', '<>', '')
            ->groupBy('symbol')
            ->get();
        $data = array();

        foreach ($items as $item) {
            $data[] =  array('name' => $item->symbol, 'y' => $item->pl);
        }

        return \Chart::title([
            false
        ])
            ->subtitle([
                false
            ])
            ->chart([
                'plotBackgroundColor' => null,
                'plotBorderWidth' => null,
                'plotShadow' => false,
                'type'     => 'bar',
                'renderTo' => 'pairs',
            ])
            ->credits([
                'enabled' => false
            ])
            ->plotOptions([
                'pie' => [
                    'allowPointSelect' => true,
                    'cursor' => 'pointer',
                    'dataLabels' => [
                        'enabled' => true,
                        'style' => [
                            'color' => 'black'
                        ]
                    ]
                ]
            ])
            ->series([
                [
                    'colorByPoint' => true,
                    'data' => $data
                ]
            ]);
    }

    private static function displayChart($name, $chart)
    {
        return "<div id=\"$name\"></div>{$chart->display()}";
    }
}
