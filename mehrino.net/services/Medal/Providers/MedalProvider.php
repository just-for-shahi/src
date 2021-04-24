<?php

namespace Services\Medal\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Medal\Repositories\IMedalRepository;
use Services\Medal\Repositories\MedalRepository;
#endregion

/**
 * Medal
 * @author Sajadweb
 * Fri Dec 25 2020 13:23:17 GMT+0330 (Iran Standard Time)
 */
class MedalProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/MedalHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Medal\Controllers')
                ->group(base_path('services/Medal/Routes/api.php'));
        #region Repository
        $this->app->bind(IMedalRepository::class,MedalRepository::class);
        #endregion
    }
}
