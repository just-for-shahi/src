<?php

namespace Services\Project\Providers;

#region use
use Services\Project\Repositories\IProjectReportRepository;
use Services\Project\Repositories\ProjectReportRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Project\Repositories\IProjectRepository;
use Services\Project\Repositories\ProjectRepository;

#endregion

/**
 * Project
 * @author Sajadweb
 * Mon Dec 21 2020 17:35:28 GMT+0330 (Iran Standard Time)
 */
class ProjectProvider extends ServiceProvider
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
        require_once __DIR__ . "/../Helpers/ProjectHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
            ->prefix('api')
            ->namespace('Services\Project\Controllers')
            ->group(base_path('services/Project/Routes/api.php'));
        Route::middleware('web')
            ->prefix('panel')
            ->namespace('Services\Project\Controllers')
            ->group(base_path('services/Project/Routes/web.php'));
        #region Repository
        $this->app->bind(IProjectReportRepository::class, ProjectReportRepository::class);
        $this->app->bind(IProjectRepository::class, ProjectRepository::class);
        #endregion
    }
}
