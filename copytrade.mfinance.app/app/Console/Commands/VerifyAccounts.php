<?php

namespace App\Console\Commands;

use App\Console\Commands\BaseCommand;
use App\Enums\MT4_RunReturnType;
use App\Helpers\MT4Commands;
use App\Mail\AccountInvalidMail;
use App\ManagerMailer;
use App\Models\Account;
use App\Models\AccountStatus;
use Illuminate\Support\Facades\Log;

class VerifyAccounts extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'accounts:verify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify accounts';

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
            $accounts = Account
                ::with('broker_server')
                ->with('user:id,email')
                ->with('api_server')
                ->whereHas('broker_server', static function ($query) {
                    $query->api();
                })
                ->whereHas('api_server', static function ($query) {
                    $query->enabled();
                })
                ->where('account_status', AccountStatus::VERIFYING)
                ->get();

            foreach ($accounts as $account) {
                $ret = MT4Commands::check(
                    $account->api_server_ip,
                    $account->broker_server_name,
                    $account->account_number,
                    $account->password
                );

                $this->info('Verifying account', ['acc' => $account->account_number]);

                $code = $ret->GetReturnType();

                if ($code & MT4_RunReturnType::ACCOUNT_INVALID) {
                    $account->account_status = AccountStatus::INVALID;
                    $account->last_error = $ret->GetMessage();
                    $this->alert('Account invalid', [
                        'acc' => $account->account_number,
                        'ip' => $account->api_server_ip,
                        'broker' => $account->broker_server_name,
                    ]);

                    if(config('admin.send_account_invalid_email')) {
                        try {
                            ManagerMailer::handle(
                                $account->user->email,
                                new AccountInvalidMail(
                                    $account->account_number,
                                    $account->broker_server_name,
                                    $account->manager_id)
                            );
                        } catch (\Exception $e) {
                            Log::exception($e);
                        }
                    }
                }

                if ($code & MT4_RunReturnType::FAILED_REPEATABLE) {
                    //$account->account_status = AccountStatus::PENDING;
                    $account->last_error = $ret->GetMessage();

                    $this->info('Failed to verify account, repeating', [
                        'acc' => $account->account_number,
                        'msg' => $ret->GetMessage(),
                    ]);
                }

                if ($code & MT4_RunReturnType::FAILED) {
                    $account->account_status = AccountStatus::INVALID;
                    $account->last_error = $ret->GetMessage();
                    $this->error('Failed to verify account. stopping', [
                        'acc' => $account->account_number,
                        'msg' => $ret->GetMessage()
                    ]);
                }

                if ($code & MT4_RunReturnType::OK) {
                    $this->info('Account verified. OK', ['acc' => $account->account_number]);
                    $account->last_error = '';
                }
                $account->save();
            }
        } catch (\Exception $e) {
            $this->critical($e->getMessage());
        }
    }
}
