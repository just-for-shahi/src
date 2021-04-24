<?php

namespace Services\Event\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Event\Repositories\IEventRepository;
use Services\Event\Repositories\EventRepository;
#endregion

/**
 * Event
 * @author Sajadweb
 * Fri Dec 25 2020 02:39:05 GMT+0330 (Iran Standard Time)
 */
class EventProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/EventHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Event\Controllers')
                ->group(base_path('services/Event/Routes/api.php'));
        #region Repository
        $this->app->bind(IEventRepository::class,EventRepository::class);
        #endregion
    }
}
