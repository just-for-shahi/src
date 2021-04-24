<?php

namespace Services\Credit\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Credit\Repositories\ICreditRepository;
use Services\Credit\Repositories\CreditRepository;
#endregion

/**
 * Credit
 * @author Sajadweb
 * Sun Dec 27 2020 13:50:31 GMT+0330 (Iran Standard Time)
 */
class CreditProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/CreditHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Credit\Controllers')
                ->group(base_path('services/Credit/Routes/api.php'));
        #region Repository
        $this->app->bind(ICreditRepository::class,CreditRepository::class);
        #endregion
    }
}
