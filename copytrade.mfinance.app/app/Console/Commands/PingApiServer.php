<?php

namespace App\Console\Commands;

use App\Models\ApiServer;
use App\Models\ApiServerStatus;
use App\Console\Commands\BaseCommand;
use App\Helpers\ApiServerHelper;
use App\Helpers\MT4Commands;

class PingApiServer extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apiserver:ping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ping Api Server and gather stat';

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
            $servers = ApiServer::withCount('accounts')->enabled()->get();

            foreach ($servers as $server) {
                $ip = $server->ip;

                try {
                    $hostName = MT4Commands::host_info($server->ip);
                } catch (\Exception $ex) {
                    $this->emergency(
                        'API server is down',
                        ['ip' => $ip, 'ex' => $ex->getMessage()]
                    );
                    $server->api_server_status = ApiServerStatus::DOWN;
                    $server->save();
                    continue;
                }

                $mem = ApiServerHelper::getStatMemLast($hostName);
                if ($mem) {
                    $server->mem = $mem->GetVal();
                }
                $cpu = ApiServerHelper::getStatCpuLast($hostName);
                if ($cpu) {
                    $server->cpu = $cpu->GetVal();
                }

                $server->api_server_status = ApiServerStatus::UP;
                $server->host_name = $hostName;

                $server->save();
            }
        } catch (\Exception $e) {
            $this->critical($e->getMessage());
        }
    }
}
