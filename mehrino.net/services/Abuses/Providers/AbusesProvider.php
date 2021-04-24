<?php

namespace Services\Abuses\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Abuses\Repositories\IAbusesRepository;
use Services\Abuses\Repositories\AbusesRepository;
#endregion

/**
 * Abuses
 * @author Sajadweb
 * Sun Dec 27 2020 14:11:39 GMT+0330 (Iran Standard Time)
 */
class AbusesProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/AbusesHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Abuses\Controllers')
                ->group(base_path('services/Abuses/Routes/api.php'));
        #region Repository
        $this->app->bind(IAbusesRepository::class,AbusesRepository::class);
        #endregion
    }
}
