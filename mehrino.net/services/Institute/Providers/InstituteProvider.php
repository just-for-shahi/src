<?php

namespace Services\Institute\Providers;

#region use
use Services\Institute\Repositories\IInstituteWorkHoursRepository;
use Services\Institute\Repositories\InstituteWorkHoursRepository;
use Services\Institute\Repositories\IInstituteBoardMemberRepository;
use Services\Institute\Repositories\InstituteBoardMemberRepository;
use Services\Institute\Repositories\IBranchRepository;
use Services\Institute\Repositories\BranchRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Institute\Repositories\IInstituteRepository;
use Services\Institute\Repositories\InstituteRepository;
#endregion

/**
 * Institute
 * @author Sajadweb
 * Mon Dec 21 2020 14:19:14 GMT+0330 (Iran Standard Time)
 */
class InstituteProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/InstituteHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Institute\Controllers')
                ->group(base_path('services/Institute/Routes/api.php'));
        #region Repository
      $this->app->bind(IInstituteWorkHoursRepository::class,InstituteWorkHoursRepository::class);
      $this->app->bind(IInstituteBoardMemberRepository::class,InstituteBoardMemberRepository::class);
      $this->app->bind(IBranchRepository::class,BranchRepository::class);
        $this->app->bind(IInstituteRepository::class,InstituteRepository::class);
        #endregion
    }
}
