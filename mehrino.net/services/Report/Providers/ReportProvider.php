<?php

namespace Services\Report\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Report\Repositories\IReportRepository;
use Services\Report\Repositories\ReportRepository;
#endregion

/**
 * Report
 * @author Sajadweb
 * Mon Jan 11 2021 21:18:28 GMT+0330 (Iran Standard Time)
 */
class ReportProvider extends ServiceProvider
{

    public function boot(){
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
        require_once __DIR__ . "/../Helpers/ReportHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        #endregion
        Route::middleware('web')
        ->namespace('Services\Report\Controllers')
        ->group(base_path('services/Report/Routes/web.php'));

        Route::middleware('api')
            ->prefix('api')
            ->namespace('Services\Report\Controllers')
            ->group(base_path('services/Report/Routes/api.php'));
        #region Repository
        #region Repository
        $this->app->bind(IReportRepository::class, ReportRepository::class);
        #endregion
    }
}
