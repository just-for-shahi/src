<?php

namespace App\Console\Commands;

use App\Console\Commands\BaseCommand;
use App\Helpers\MT4Commands;
use App\Jobs\ProcessPendingAccount;
use App\ManagerMailer;
use App\Models\Account;
use App\Models\AccountStatus;
use App\Models\JfxMode;
use Illuminate\Support\Str;
use App\Mail\AccountRestartedMail;
use App\User;

class PingAccounts extends BaseCommand
{
    protected $signature = 'accounts:ping';

    protected $description = 'Ping accounts';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $diff = 300; //seconds

        try {

            $jfxMode = config('copier.jfx_mode');

            $accounts = Account
                ::with('broker_server')
                ->with('api_server')
                ->whereHas('api_server', static function ($query) {
                    $query->enabled();
                })
                ->whereHas('broker_server', static function ($query) {
                    $query->api();
                })
                ->where('account_status', AccountStatus::ONLINE)
                ->selectRaw('*, TIMESTAMPDIFF(SECOND , accounts.updated_at, now() ) as diff')
                ->get();

            if($jfxMode&JfxMode::COPIER_DISABLED != JfxMode::COPIER_DISABLED ) {
                $data['channel'] = 'system';
                $data['command'] = 'get_online';
                $ws_host = config('admin.ws_host');
                $accountsOnline = MT4Commands::wsSendCommand($ws_host, \json_encode($data));
            }

            foreach ($accounts as $account) {

                $is_restart = false;

                if ($account->diff >= $diff) {
                    $this->warning(
                        "Account is not updated db status more than $diff seconds. Restarting",
                        [
                            'ip' => $account->api_server_ip,
                            'account_number' => $account->account_number,
                            'broker' => $account->broker_server_name,
                            'diff' => $account->diff
                        ]
                    );
                    $is_restart = true;
                }

                if($jfxMode&JfxMode::COPIER_DISABLED != JfxMode::COPIER_DISABLED ) {
                    if (Str::contains($accountsOnline, $account->account_number.';') == false) {
                        $this->warning("Ping is false. Restarting", [
                            'ip' => $account->api_server_ip,
                            'account_number' => $account->account_number,
                            'broker' => $account->broker_server_name,
                            'ws_host' => $ws_host
                        ]);

                        $is_restart = true;
                    }
                } else {
                    //$this->info('Copier ping is disabled');
                }

                if ($is_restart) {
                    $account->processing = true;
                    $account->account_status = AccountStatus::PENDING;
                    $account->save();

                    ProcessPendingAccount::dispatch($account->id)->onQueue($account->getConnectingQueueName());
                    $manager = User::find($account->manager_id);

                    ManagerMailer::handle(
                        $manager->email,
                        new AccountRestartedMail(
                            $account->account_number,
                            $account->broker_server_name,
                            $manager->id
                        )
                    );
                }
            }
        } catch (\Exception $e) {
            $this->critical($e->getMessage());
            echo $e->getMessage();
        }
    }
}
