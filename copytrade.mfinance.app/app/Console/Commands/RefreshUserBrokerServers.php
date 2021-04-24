<?php

namespace App\Console\Commands;

use App\User;
use App\Models\BrokerServer;
use App\Models\UserBrokerServer;
use App\Console\Commands\BaseCommand;

class RefreshUserBrokerServers extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'brokerservers:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refersh user broker servers';

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
            $brokerServers = BrokerServer::api()->get();

            $users = User::with('permissions')
                ->whereHas('permissions', function ($q) {
                    $q->where('slug', 'mng.broker_servers');
                })
                ->get(['admin_users.id']);

            foreach ($brokerServers as $brokerServer) {
                foreach ($users as $user) {
                    //echo $user->id;
                    UserBrokerServer::firstOrCreate(['user_id' => $user->id, 'broker_server_id' => $brokerServer->id], ['enabled' => 0]);
                }
            }
        } catch (\Exception $e) {
            $this->critical($e->getMessage());
            echo $e->getMessage();
        }
    }
}
