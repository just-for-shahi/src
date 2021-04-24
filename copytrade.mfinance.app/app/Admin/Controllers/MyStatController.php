<?php

namespace App\Admin\Controllers;

use App\Helpers\ApiServerHelper;
use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Callout;
use App\Models\ApiServer;
use App\Models\ApiServerStatus;

class MyStatController extends Controller
{
    public function index(Content $content)
    {
        $content->title('Server Statistics');

        if (Auth('admin')->user()->isAdministrator()) {
            $servers = ApiServer::enabled()->get();
        } else
            $servers = ApiServer::whereManagerId(Auth('admin')->user()->id)->get();

        foreach ($servers as $server) {
            $chart = $this->buildServerChart($server->host_name);
            $chart = $chart->display();
            $status = ApiServerStatus::title($server->api_server_status);
            $box = new Box(
                "RAM/CPU of '{$server->title}. Server is {$status}",
                "<div id=\"server{$server->host_name}\"></div>$chart"
            );

            if ($server->api_server_status == ApiServerStatus::UP) {
                $box = $box->style('info');
            }

            if ($server->api_server_status == ApiServerStatus::DOWN) {
                $box = $box->style('danger');
            }

            $content->row($box->solid());
        }

        return $content;
    }


    private function buildServerChart($hostName)
    {
        $itemsCpu = ApiServerHelper::getStatCpuFull($hostName, 'user');
        $dataCPU = array();
        $dataRAM = array();

        foreach ($itemsCpu as $item) {
            $dataCPU[] =  array(strtotime($item->GetDate()) * 1000, $item->GetVal());
        }

        $itemsMem = ApiServerHelper::getStatMemFull($hostName);
        foreach ($itemsMem as $item) {
            $dataRAM[] =  array(strtotime($item->GetDate()) * 1000, $item->GetVal());
        }

        return \Chart::title([
            false
        ])
            ->subtitle([
                false
            ])
            ->chart([
                'type'     => 'line',
                'renderTo' => 'server' . $hostName,
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
                    'name' => 'CPU',
                    'data' => $dataCPU
                ],
                [
                    'name' => 'RAM',
                    'data' => $dataRAM
                ]
            ]);
    }
}
