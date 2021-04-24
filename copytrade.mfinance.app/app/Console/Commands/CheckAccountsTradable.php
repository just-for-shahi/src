<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\AccountStatus;
use App\Models\CopierType;
use App\Console\Commands\BaseCommand;
use App\Enums\MT4_RunReturnType;
use App\Helpers\MT4Commands;

class CheckAccountsTradable extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'accounts:check_tradable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check accounts tradable';

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

            $accounts = Account::with('manager:id,username')
                ->where('account_status', AccountStatus::ONLINE)
                ->where('trade_allowed', 0)
                ->where('copier_type', CopierType::SLAVE)
                ->get(['account_number', 'broker_server_name','api_server_ip','manager_id'])
                ->toArray();

            if(count($accounts) > 0)
                $this->alert('Slave Accounts with investor passwords', ['accounts' => $accounts]);

            $accounts = Account::with('manager:id,username')
                ->with('broker_server')
                ->with('api_server')
                ->whereHas('broker_server', static function ($query) {
                    $query->api()->where(static function ($q) {
                        //$q->where('suffix', '=', '')->orWhereNull('suffix');
                        $q->whereNull('suffix');
                    });
                })
                ->whereHas('api_server', static function ($query) {
                    $query->enabled();
                })
                ->where('copier_type', CopierType::SLAVE)
                ->where('account_status', AccountStatus::ONLINE)
                ->where('trade_allowed', 1)
                ->where('symbol_trade_allowed', 0)
                ->get(['account_number','api_server_ip','manager_id'])
                ->toArray();
            if(count($accounts) > 0)
                $this->alert('Slave Accounts with fake pairs name and empty broker suffix', ['accounts' => $accounts]);
        } catch (\Exception $e) {
            $this->critical($e->getMessage());
        }
    }
}
