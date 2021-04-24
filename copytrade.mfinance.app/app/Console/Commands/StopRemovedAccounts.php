<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\AccountStatus;
use App\Jobs\ProcessRemovedAccount;
use App\Console\Commands\BaseCommand;

class StopRemovedAccounts extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'accounts:stopremoved';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stop and clean up removed accounts';

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
        $accounts = Account
            ::where('account_status', AccountStatus::REMOVING)
            ->where('processing', 0)
            ->get();

        foreach ($accounts as $account) {
            try {

                $account->processing = true;
                $account->save();
                ProcessRemovedAccount::dispatch($account->id)->onQueue($account->getRemovingQueueName());

            } catch (\Exception $e) {
                $this->critical('Failed to stop removed account', [
                    'acc' => $account->account_number, 'ex' => $e->getMessage()
                ]);
            }
        }
    }
}
