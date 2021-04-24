<?php

namespace Services\Follow\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Follow\Repositories\IFollowRepository;
use Services\Follow\Repositories\FollowRepository;
#endregion

/**
 *Follow
 * @author Sajadweb
 * Sat Jan 09 2021 19:57:43 GMT+0330 (Iran Standard Time)
 */
class FollowProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/FollowHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Follow\Controllers')
                ->group(base_path('services/Follow/Routes/api.php'));
        #region Repository
        $this->app->bind(IFollowRepository::class,FollowRepository::class);
        #endregion
    }
}
