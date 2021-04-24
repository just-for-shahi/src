<?php

namespace Services\Wishlist\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Wishlist\Repositories\IWishlistRepository;
use Services\Wishlist\Repositories\WishlistRepository;
#endregion

/**
 * Wishlist
 * @author Sajadweb
 * Fri Dec 25 2020 02:44:39 GMT+0330 (Iran Standard Time)
 */
class WishlistProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/WishlistHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Wishlist\Controllers')
                ->group(base_path('services/Wishlist/Routes/api.php'));
        #region Repository
        $this->app->bind(IWishlistRepository::class,WishlistRepository::class);
        #endregion
    }
}
