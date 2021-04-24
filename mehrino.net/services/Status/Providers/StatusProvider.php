<?php

namespace Services\Status\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Status\Repositories\IStatusRepository;
use Services\Status\Repositories\StatusRepository;
#endregion

/**
 * Status
 * @author Sajadweb
 * Sat Jan 09 2021 19:57:43 GMT+0330 (Iran Standard Time)
 */
class StatusProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/StatusHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Status\Controllers')
                ->group(base_path('services/Status/Routes/api.php'));
        #region Repository
        $this->app->bind(IStatusRepository::class,StatusRepository::class);
        #endregion
    }
}
