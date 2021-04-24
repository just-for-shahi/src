<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Enums\ApiServerStatReturn;
use Illuminate\Support\Facades\Redis;

class ApiServerHelper
{
    public static function uploadSrv($file_name, $file_data, $ip)
    {
        $file_name .= '.srv';
        self::upload('Srv', $file_name, $file_data, $ip);
    }

    public static function upload($type, $file_name, $file_data, $ip)
    {
        $client = new \GuzzleHttp\Client();
        $port = config('copier.api_service_port');
        $endpoint = "http://$ip:$port";

        $response = $client->request(
            'POST',
            $endpoint,
            [
                'query' =>
                [
                    'action' => 'upload',
                    'type' => $type,
                    'filename' => $file_name
                ],
                'body' => \base64_encode($file_data),
            ]
        );

        $statusCode = $response->getStatusCode();
        $content = $response->getBody();

        //echo $content;

        if ($statusCode != 200) {
            return false;
        }

        return true;
    }

    /**
     * Get Server memory stat last value
     *
     * @param string $host_name
     * @return ApiServerStatReturn
     */
    public static function getStatMemLast($host_name)
    {
        $stat = Redis::lrange($host_name . 'memory', -1, -1);

        $mem = -1;
        $date = Carbon::now()->format('Y-m-d\TH:i:s\Z');

        if (count($stat) > 0) {
            Redis::ltrim($host_name . 'memory', -100, -1);

            $stat = str_replace('@', '', $stat[0]);
            $stat = json_decode($stat);

            $date = $stat->timestamp;
            $mem = $stat->system->memory->used->pct;
            $mem = $mem * 100;
        }

        return new ApiServerStatReturn($date, $mem);
    }

    /**
     * Get Server memory stat last value
     *
     * @param string $host_name
     * @return ApiServerStatReturn
     */
    public static function getStatCpuLast($host_name)
    {
        $cpu = -1;
        $date = Carbon::now()->format('Y-m-d\TH:i:s\Z');

        $stat = Redis::lrange($host_name . 'cpu', -1, -1);

        if (count($stat) > 0) {
            Redis::ltrim($host_name . 'cpu', -100, -1);

            $stat = str_replace('@', '', $stat[0]);
            $stat = json_decode($stat);

            $date = $stat->timestamp;
            $cpu = $stat->system->cpu->total->pct;
            $cpu = $cpu * 100;
        }

        return new ApiServerStatReturn($date, $cpu);
    }

    /**
     * Get Full stat for host
     *
     * @param string $host_name
     * @return ApiServerStatReturn[]
     */
    public static function getStatMemFull($host_name)
    {
        $stats = Redis::lrange($host_name . 'memory', -100, -1);

        $data = array();
        foreach ($stats as $stat) {

            try {
                $stat = str_replace('@', '', $stat);
                $stat = json_decode($stat);

                $date = $stat->timestamp;
                $mem = $stat->system->memory->used->pct;
                $mem = \round($mem * 100, 2 );

                $data[] = new ApiServerStatReturn($date, $mem);
            } catch(\Exception $e) {

            }
        }

        return $data;
    }

    /**
     * Get API server stat for CPU
     *
     * @param string $host_name
     * @return ApiServerStatReturn[]
     */
    public static function getStatCpuFull($host_name, $key = 'system')
    {
        $stats = Redis::lrange($host_name . 'cpu', -100, -1);

        $data = array();
        foreach ($stats as $stat) {
            $stat = str_replace('@', '', $stat);
            $stat = json_decode($stat);

            //print_r($stat);

            $date = $stat->timestamp;
            $cpu = $stat->system->cpu->{$key}->pct;
            $cpu = \round($cpu * 100, 2 );

            $data[] = new ApiServerStatReturn($date, $cpu);
        }

        return $data;
    }
}
