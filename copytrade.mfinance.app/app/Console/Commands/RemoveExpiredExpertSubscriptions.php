<?php

namespace App\Console\Commands;

use App\Console\Commands\BaseCommand;
use App\Models\UserExpertSubscription;

class RemoveExpiredExpertSubscriptions extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'experts:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove Expired Expert Subscriptions';

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
            $subscriptions = UserExpertSubscription::where('expired_at', '<=', date("Y-m-d"))->get();

            foreach ($subscriptions as $subscription) {
                $this->info('Removing expired experts subscription', [
                    'expert_subscription_id' => $subscription->expert_subscription_id,
                    'user_id' => $subscription->user_id
                ]);
                $subscription->delete();
            }
        } catch (\Exception $e) {
            $this->critical($e->getMessage());
        }
    }
}
