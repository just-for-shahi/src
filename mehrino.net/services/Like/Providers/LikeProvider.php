<?php

namespace Services\Like\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Like\Repositories\ILikeRepository;
use Services\Like\Repositories\LikeRepository;
#endregion

/**
 * Like
 * @author Sajadweb
 * Fri Dec 25 2020 02:40:00 GMT+0330 (Iran Standard Time)
 */
class LikeProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/LikeHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Like\Controllers')
                ->group(base_path('services/Like/Routes/api.php'));
        #region Repository
        $this->app->bind(ILikeRepository::class,LikeRepository::class);
        #endregion
    }
}
