<?php

namespace App\Jobs;

use App\Models\Account;
use App\Models\AccountRemoved;
use App\Helpers\MT4Commands;
use App\Jobs\ShouldQueueBase;
use App\Models\AccountStatus;
use App\Enums\MT4_RunReturnType;

final class ProcessRemovedAccount extends ShouldQueueBase
{
    private $accountId;
    private $accountStatus;

    protected $signature = 'account:remove';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $account = Account::find($this->accountId);

        if ($account == null || $account->account_status != AccountStatus::REMOVING) {
            $this->info('Removed account not found', ['acc' => $this->accountId]);
            return;
        }

        $this->info('Stopping removed account', [
            'acc' => $account->account_number
        ]);


        $ret = MT4Commands::stop($account->api_server_ip, $account->broker_server_name, $account->account_number, $account->password);

        $this->info('Removed account is stopped', [
            'acc' => $account->account_number, 'msg' => $ret
        ]);

        $accountRemoved = AccountRemoved::firstOrNew(['account_number' => $account->account_number]);

        $accountRemoved->account_number = $account->account_number;
        $accountRemoved->password = $account->password;
        $accountRemoved->broker_server_name = $account->broker_server_name;
        $accountRemoved->manager_id = $account->manager_id;
        $accountRemoved->creator_id = $account->creator_id;
        $accountRemoved->trade_allowed = $account->trade_allowed;
        $accountRemoved->symbol_trade_allowed = $account->symbol_trade_allowed;
        $accountRemoved->last_error = $account->last_error;
        $accountRemoved->is_live = $account->is_live;
        $accountRemoved->copier_type = $account->copier_type;
        $accountRemoved->api_server_ip = $account->api_server_ip;

        $accountRemoved->save();

        $account->delete();
    }

    public function failed(\Exception $exception)
    {
        $this->critical($exception);
    }

    public function tags()
    {
        return ['removing', 'account:' . $this->accountId];
    }
}
