<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Helpers\MT4Commands;
use App\Enums\MT4_RunReturnType;
use App\Models\AccountStatus;

use App\Console\Commands\BaseCommand;

class StopDisabledAccounts extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'accounts:stopdisabled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kill accounts on VPS which are invalid or suspended';

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
        $accounts = Account::whereIn('account_status', [AccountStatus::INVALID, AccountStatus::SUSPEND])
            ->get();

        foreach ($accounts as $account) {

            $msg = '';
            if ($account->account_status == AccountStatus::INVALID) {
                $this->info('Stopping account because of invalid');
            }

            if ($account->account_status == AccountStatus::SUSPEND)
                $this->info('Stopping account because of suspend');

            $ret = MT4Commands::stop(
                $account->api_server_ip,
                $account->broker_server_name,
                $account->account_number,
                $account->password
            );

            $code = $ret->GetReturnType();

            if ($code & MT4_RunReturnType::FAILED_REPEATABLE) {
                $account->last_error = $ret->GetMessage();

                $this->alert('Failed to stop account, repeating', [
                    'acc' => $account->account_number,
                    'api' => $account->api_server_ip,
                    'msg' => $ret->GetMessage()
                ]);
                $account->last_error = $ret->GetMessage();
                $account->save();

                continue;
            }

            if ($account->account_status == AccountStatus::INVALID) {
                $account->account_status = AccountStatus::INVALID_STOPPED;
                $this->info($msg, ['acc' => $account->account_number]);
            }

            if ($account->account_status == AccountStatus::SUSPEND) {
                $account->account_status = AccountStatus::SUSPEND_STOPPED;
                $this->info($msg, ['acc' => $account->account_number]);
            }

            $account->save();
        }
    }
}
