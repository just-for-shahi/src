<?php

namespace Services\Wall\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Wall\Repositories\IWallPostRepository;
use Services\Wall\Repositories\IWallRepository;
use Services\Wall\Repositories\IWallRequestRepository;
use Services\Wall\Repositories\WallPostRepository;
use Services\Wall\Repositories\WallRepository;
use Services\Wall\Repositories\WallRequestRepository;
#endregion

/**
 * Wall
 * @author Sajadweb
 * Fri Dec 25 2020 02:44:18 GMT+0330 (Iran Standard Time)
 */
class WallProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/WallHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Wall\Controllers')
                ->group(base_path('services/Wall/Routes/api.php'));
        #region Repository
        $this->app->bind(IWallRequestRepository::class,WallRequestRepository::class);
        $this->app->bind(IWallPostRepository::class, WallPostRepository::class);
        $this->app->bind(IWallRepository::class, WallRepository::class);
        #endregion
    }
}
