<?php

namespace Services\Comment\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Comment\Repositories\ICommentRepository;
use Services\Comment\Repositories\CommentRepository;
#endregion

/**
 * Comment
 * @author Sajadweb
 * Sun Dec 27 2020 13:51:25 GMT+0330 (Iran Standard Time)
 */
class CommentProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/CommentHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Comment\Controllers')
                ->group(base_path('services/Comment/Routes/api.php'));
        #region Repository
        $this->app->bind(ICommentRepository::class,CommentRepository::class);
        #endregion
    }
}
