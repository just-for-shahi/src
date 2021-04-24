<?php

namespace Services\Device\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Device\Repositories\IDeviceRepository;
use Services\Device\Repositories\DeviceRepository;
#endregion

/**
 * Device
 * @author Sajadweb
 * Sun Dec 27 2020 13:25:38 GMT+0330 (Iran Standard Time)
 */
class DeviceProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/DeviceHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Device\Controllers')
                ->group(base_path('services/Device/Routes/api.php'));
        #region Repository
        $this->app->bind(IDeviceRepository::class,DeviceRepository::class);
        #endregion
    }
}
