<?php

namespace Services\Voluntary\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Voluntary\Repositories\IVoluntaryCertificateRepository;
use Services\Voluntary\Repositories\IVoluntaryRequestRepository;
use Services\Voluntary\Repositories\IVoluntaryWorkRepository;
use Services\Voluntary\Repositories\VoluntaryCertificateRepository;
use Services\Voluntary\Repositories\VoluntaryRequestRepository;
use Services\Voluntary\Repositories\VoluntaryWorkRepository;

#endregion

/**
 * Voluntary
 * @author Sajadweb
 * Sun Dec 27 2020 14:01:39 GMT+0330 (Iran Standard Time)
 */
class VoluntaryProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/VoluntaryHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Voluntary\Controllers')
                ->group(base_path('services/Voluntary/Routes/api.php'));
        #region Repository
        $this->app->bind(IVoluntaryRequestRepository::class,VoluntaryRequestRepository::class);
        $this->app->bind(IVoluntaryCertificateRepository::class,VoluntaryCertificateRepository::class);
        $this->app->bind(IVoluntaryWorkRepository::class,VoluntaryWorkRepository::class);
        #endregion
    }
}
