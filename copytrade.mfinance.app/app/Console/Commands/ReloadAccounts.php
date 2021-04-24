<?php

namespace App\Console\Commands;

use App\Jobs\ProcessPendingAccount;
use App\Models\ApiServer;
use App\Models\AccountStatus;

class ReloadAccounts extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'accounts:reload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reload pending accounts';

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
            $apiServers = ApiServer::enabled()->get();

            foreach ($apiServers as $apiServer) {
                $accounts = $apiServer
                    ->accounts()
                    ->where('account_status', AccountStatus::PENDING)
                    ->where('processing', 0)
                    ->get(['id']);

                if(count($accounts) < 1) {
                    continue;
                }
                $this->info('Reloading pending accounts', ['api_server' => $apiServer->ip, 'count' => count($accounts)]);

                foreach ($accounts as $account) {
                    $account->processing = true;
                    $account->save();

                    ProcessPendingAccount::dispatch($account->id)->onQueue($account->getConnectingQueueName());
                }
            }
        } catch (\Exception $e) {
            $this->critical($e);
        }
    }
}
