<?php

namespace Services\Location\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Location\Repositories\ILocationRepository;
use Services\Location\Repositories\LocationRepository;
#endregion

/**
 * Location
 * @author Sajadweb
 * Wed Jan 13 2021 17:38:02 GMT+0330 (Iran Standard Time)
 */
class LocationProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/LocationHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Location\Controllers')
                ->group(base_path('services/Location/Routes/api.php'));
        #region Repository
        $this->app->bind(ILocationRepository::class,LocationRepository::class);
        #endregion
    }
}
