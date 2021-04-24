<?php

namespace App\Console\Commands;

use App\Console\Commands\BaseCommand;
use App\Models\Order;
use Carbon\Carbon;

class RemoveOldTradeErrors extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trades:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up old trade errors';

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
            $this->info('Removing old trade errors');

            Order::where('time_created','<',Carbon::now()->subDay(7))->delete();

        } catch (\Exception $e) {
            $this->critical($e->getMessage());
        }
    }
}
