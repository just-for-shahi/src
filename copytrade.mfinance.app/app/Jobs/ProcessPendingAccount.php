<?php

namespace App\Jobs;

use App\Models\Account;
use App\Helpers\MT4Commands;
use App\Jobs\ShouldQueueBase;
use App\Models\AccountStatus;
use App\Enums\MT4_RunReturnType;
use Illuminate\Support\Facades\Redis;

final class ProcessPendingAccount extends ShouldQueueBase
{
    private $accountId;

    protected $signature = 'account:reload';

    public $timeout = 120;
    public $tries = 5;

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
        $account = Account::with('api_server')->with('manager:api_token')->find($this->accountId);

        if ($account == null || $account->account_status != AccountStatus::PENDING) {
            $this->info('Pending account not found', ['acc' => $this->accountId]);
            return;
        }

        if(empty($account->password)) {
            $this->alert('Password is empty', [
                'id' => $this->accountId,
                'ip' => $account->api_server_ip,
                'broker' => $account->broker_server_name,
                'acc' => $account->account_number
                ]);

            $account->account_status = AccountStatus::INVALID;
            $account->last_error = 'Password is empty';
            $account->processing = false;
            $account->save();

            return;
        }

        //$maxProcessing = $account->api_server->max_processing_accounts;
        //$key = $account->api_server_ip;

        //Redis::funnel($key)->limit($maxProcessing)->then(function () use($account) {

            $this->info('Starting account', [
                'id' => $this->accountId,
                'ip' => $account->api_server_ip,
                'broker' => $account->broker_server_name,
                'acc' => $account->account_number,
                'pwd' => substr($account->password, 0, 2)
            ]);

            $ret = MT4Commands::run(
                $account->api_server_ip, $account->broker_server_name,
                $account->manager()->first()->api_token, $account->jfx_mode,
                $this->accountId, $account->account_number, $account->password);

            $code = $ret->GetReturnType();

            if (($code & MT4_RunReturnType::OK) == MT4_RunReturnType::OK) {
                $account->account_status = AccountStatus::VERIFYING;
                $account->last_error = '';
                $this->info('Account started, verifying...',
                    ['id' => $this->accountId, 'acc' => $account->account_number]);
            }

            if (($code & MT4_RunReturnType::FAILED) == MT4_RunReturnType::FAILED) {
                $account->account_status = AccountStatus::INVALID;
                $account->last_error = $ret->GetMessage();
            }

            if ($code & MT4_RunReturnType::FAILED_W_ALERT) {
                $this->alert('Account failed to start.', [
                    'id' => $this->accountId,
                    'acc' => $account->account_number,
                    'msg' => $ret->GetMessage(),
                    'ip' => $account->api_server_ip
                ]);
            }

            if (($code & MT4_RunReturnType::FAILED_REPEATABLE) == MT4_RunReturnType::FAILED_REPEATABLE) {
                $account->account_status = AccountStatus::PENDING;
                $account->last_error = $ret->GetMessage();

                $this->info('Account failed to start, repeating', [
                    'id' => $this->accountId,
                    'acc' => $account->account_number,
                    'ip' => $account->api_server_ip,
                    'msg' => $ret->GetMessage()
                ]);
            }

            $account->processing = false;
            $account->save();
        //}, function () {
          //  return $this->release(120);
        //});
    }

    public function failed(\Exception $exception)
    {
        $this->critical($exception);
    }

    public function tags()
    {
        return ['connecting', 'account:'.$this->accountId];
    }
}
