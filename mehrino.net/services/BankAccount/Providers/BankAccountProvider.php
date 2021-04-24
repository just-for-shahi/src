<?php

namespace Services\BankAccount\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\BankAccount\Repositories\IBankAccountRepository;
use Services\BankAccount\Repositories\BankAccountRepository;
#endregion

/**
 * BankAccount
 * @author Sajadweb
 * Sun Dec 27 2020 13:30:10 GMT+0330 (Iran Standard Time)
 */
class BankAccountProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/BankAccountHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\BankAccount\Controllers')
                ->group(base_path('services/BankAccount/Routes/api.php'));
        #region Repository
        $this->app->bind(IBankAccountRepository::class,BankAccountRepository::class);
        #endregion
    }
}
