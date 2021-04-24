<?php

namespace Services\Post\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Post\Repositories\IPostRepository;
use Services\Post\Repositories\PostRepository;
#endregion

/**
 * Post
 * @author Sajadweb
 * Sun Jan 24 2021 14:52:20 GMT+0330 (Iran Standard Time)
 */
class PostProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../Views', 'views');
    }
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/PostHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('web')
            ->namespace('Services\Post\Controllers')
            ->group(base_path('services/Post/Routes/web.php'));

        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Post\Controllers')
                ->group(base_path('services/Post/Routes/api.php'));
        #region Repository
        $this->app->bind(IPostRepository::class,PostRepository::class);
        #endregion
    }
}
