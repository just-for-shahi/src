<?php

namespace Services\Share\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Share\Repositories\IShareRepository;
use Services\Share\Repositories\ShareRepository;
#endregion

/**
 * Share
 * @author Sajadweb
 * Fri Dec 25 2020 02:41:23 GMT+0330 (Iran Standard Time)
 */
class ShareProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/ShareHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Share\Controllers')
                ->group(base_path('services/Share/Routes/api.php'));
        #region Repository
        $this->app->bind(IShareRepository::class,ShareRepository::class);
        #endregion
    }
}
