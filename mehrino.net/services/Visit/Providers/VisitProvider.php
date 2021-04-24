<?php

namespace Services\Visit\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Visit\Repositories\IVisitRepository;
use Services\Visit\Repositories\VisitRepository;
#endregion

/**
 * Visit
 * @author Sajadweb
 * Fri Dec 25 2020 02:43:12 GMT+0330 (Iran Standard Time)
 */
class VisitProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/VisitHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Visit\Controllers')
                ->group(base_path('services/Visit/Routes/api.php'));
        #region Repository
        $this->app->bind(IVisitRepository::class,VisitRepository::class);
        #endregion
    }
}
