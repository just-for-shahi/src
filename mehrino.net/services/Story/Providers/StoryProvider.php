<?php

namespace Services\Story\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Story\Repositories\IStoryRepository;
use Services\Story\Repositories\StoryRepository;
#endregion

/**
 * Story
 * @author Sajadweb
 * Fri Dec 25 2020 02:41:52 GMT+0330 (Iran Standard Time)
 */
class StoryProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/StoryHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Story\Controllers')
                ->group(base_path('services/Story/Routes/api.php'));
        #region Repository
        $this->app->bind(IStoryRepository::class,StoryRepository::class);
        #endregion
    }
}
