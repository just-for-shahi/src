<?php

namespace Services\Bookmark\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Bookmark\Repositories\IBookmarkRepository;
use Services\Bookmark\Repositories\BookmarkRepository;

#endregion

/**
 * Bookmark
 * @author Sajadweb
 * Sat Jan 09 2021 19:57:43 GMT+0330 (Iran Standard Time)
 */
class BookmarkProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/BookmarkHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
            ->prefix('api')
            ->namespace('Services\Bookmark\Controllers')
            ->group(base_path('services/Bookmark/Routes/api.php'));
        #region Repository
        $this->app->bind(IBookmarkRepository::class, BookmarkRepository::class);
        #endregion
    }
}
