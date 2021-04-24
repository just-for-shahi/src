<?php

namespace App\Console\Commands;

use App\User;
use App\Models\BrokerServer;
use App\Models\UserBrokerServer;
use App\Console\Commands\BaseCommand;
use App\Models\PortfolioStat;

class RecalcPortfolioStat extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'portfolio:recalc_stat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalc portfolio stat';

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
            $portfolios = PortfolioStat::listHasNewOrder();

            foreach ($portfolios as $portfolioId) {
                PortfolioStat::calcAdvStat($portfolioId);
            }
        } catch (\Exception $e) {
            $this->critical($e->getMessage());
            echo $e->getMessage();
        }
    }
}
