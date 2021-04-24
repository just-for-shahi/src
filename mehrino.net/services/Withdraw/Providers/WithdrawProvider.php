<?php

namespace Services\Withdraw\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Withdraw\Repositories\IWithdrawRepository;
use Services\Withdraw\Repositories\WithdrawRepository;
#endregion

/**
 * Withdraw
 * @author Sajadweb
 * Sun Dec 27 2020 13:31:04 GMT+0330 (Iran Standard Time)
 */
class WithdrawProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/WithdrawHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Withdraw\Controllers')
                ->group(base_path('services/Withdraw/Routes/api.php'));
        #region Repository
        $this->app->bind(IWithdrawRepository::class,WithdrawRepository::class);
        #endregion
    }
}
