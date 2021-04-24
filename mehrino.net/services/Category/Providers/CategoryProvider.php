<?php

namespace Services\Category\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Category\Repositories\ICategoryRepository;
use Services\Category\Repositories\CategoryRepository;
#endregion

/**
 * Category
 * @author Sajadweb
 * Fri Dec 25 2020 02:37:20 GMT+0330 (Iran Standard Time)
 */
class CategoryProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/CategoryHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Category\Controllers')
                ->group(base_path('services/Category/Routes/api.php'));
        #region Repository
        $this->app->bind(ICategoryRepository::class,CategoryRepository::class);
        #endregion
    }
}
