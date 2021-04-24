<?php

namespace App\Console\Commands;

use App\Console\Commands\BaseCommand;
use App\Models\Account;
use App\Models\AccountStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RestartInvalidAccounts extends BaseCommand
{
    protected $signature = 'accounts:restart_invalid';

    protected $description = 'Restart Invalid accounts';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $diff = 30; //minutes
        $max_tries = 5; //times

        try {

  //          DB::enableQueryLog();
            Account
                ::whereIn('account_status', [AccountStatus::INVALID, AccountStatus::INVALID_STOPPED])
                ->where('updated_at','<',Carbon::now()->subMinute($diff))
                ->where('count_invalid_restarts', '<', $max_tries)
                ->update([
                    'account_status' => AccountStatus::PENDING,
                    'count_invalid_restarts' => DB::raw('count_invalid_restarts+1')]);
//            $l = DB::getQueryLog();

//            echo Str::replaceArray('?', $l[0]['bindings'], $l[0]['query']);


        } catch (\Exception $e) {
            $this->critical($e->getMessage());
            echo $e->getMessage();
        }
    }
}
