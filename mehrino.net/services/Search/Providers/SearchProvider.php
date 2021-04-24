<?php

namespace Services\Search\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Search\Repositories\ISearchRepository;
use Services\Search\Repositories\SearchRepository;
#endregion

/**
 * Search
 * @author Sajadweb
 * Fri Dec 25 2020 02:40:34 GMT+0330 (Iran Standard Time)
 */
class SearchProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/SearchHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Search\Controllers')
                ->group(base_path('services/Search/Routes/api.php'));
        #region Repository
        $this->app->bind(ISearchRepository::class,SearchRepository::class);
        #endregion
    }
}
