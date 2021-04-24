<?php

namespace Services\Donate\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Donate\Repositories\IDonateRepository;
use Services\Donate\Repositories\DonateRepository;
#endregion

/**
 * Donate
 * @author Sajadweb
 * Fri Dec 25 2020 02:38:30 GMT+0330 (Iran Standard Time)
 */
class DonateProvider extends ServiceProvider
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
        require_once __DIR__ . "/../Helpers/DonateHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Donate\Controllers')
                ->group(base_path('services/Donate/Routes/api.php'));
        Route::middleware('web')
            ->namespace('Services\Donate\Controllers')
            ->group(base_path('services/Donate/Routes/web.php'));
        #region Repository
        $this->app->bind(IDonateRepository::class,DonateRepository::class);
        #endregion
    }
}
