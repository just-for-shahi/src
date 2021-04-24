<?php

namespace Services\BlueTick\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\BlueTick\Repositories\IBlueTickRepository;
use Services\BlueTick\Repositories\BlueTickRepository;
#endregion

/**
 * BlueTick
 * @author Sajadweb
 * Sun Dec 27 2020 14:10:25 GMT+0330 (Iran Standard Time)
 */
class BlueTickProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/BlueTickHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\BlueTick\Controllers')
                ->group(base_path('services/BlueTick/Routes/api.php'));
        #region Repository
        $this->app->bind(IBlueTickRepository::class,BlueTickRepository::class);
        #endregion
    }
}
