<?php

namespace Services\Tag\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Tag\Repositories\ITagRepository;
use Services\Tag\Repositories\TagRepository;
#endregion

/**
 * Tag
 * @author Sajadweb
 * Fri Dec 25 2020 02:42:18 GMT+0330 (Iran Standard Time)
 */
class TagProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/TagHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Tag\Controllers')
                ->group(base_path('services/Tag/Routes/api.php'));
        #region Repository
        $this->app->bind(ITagRepository::class,TagRepository::class);
        #endregion
    }
}
