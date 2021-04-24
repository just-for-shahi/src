<?php

namespace Services\Setting\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Setting\Repositories\ISettingRepository;
use Services\Setting\Repositories\SettingRepository;
#endregion

/**
 * Setting
 * @author Sajadweb
 * Fri Dec 25 2020 02:40:53 GMT+0330 (Iran Standard Time)
 */
class SettingProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/SettingHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Setting\Controllers')
                ->group(base_path('services/Setting/Routes/api.php'));
        #region Repository
        $this->app->bind(ISettingRepository::class,SettingRepository::class);
        #endregion
    }
}
