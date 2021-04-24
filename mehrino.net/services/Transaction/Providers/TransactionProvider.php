<?php

namespace Services\Transaction\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Transaction\Repositories\ITransactionRepository;
use Services\Transaction\Repositories\TransactionRepository;
#endregion

/**
 * Transaction
 * @author Sajadweb
 * Sun Dec 27 2020 14:05:43 GMT+0330 (Iran Standard Time)
 */
class TransactionProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/TransactionHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Transaction\Controllers')
                ->group(base_path('services/Transaction/Routes/api.php'));
        #region Repository
        $this->app->bind(ITransactionRepository::class,TransactionRepository::class);
        #endregion
    }
}
