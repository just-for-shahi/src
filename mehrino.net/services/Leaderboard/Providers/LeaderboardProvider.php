<?php

namespace Services\Leaderboard\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Leaderboard\Repositories\ILeaderboardRepository;
use Services\Leaderboard\Repositories\LeaderboardRepository;
#endregion

/**
 * Leaderboard
 * @author Sajadweb
 * Fri Dec 25 2020 02:39:39 GMT+0330 (Iran Standard Time)
 */
class LeaderboardProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/LeaderboardHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Leaderboard\Controllers')
                ->group(base_path('services/Leaderboard/Routes/api.php'));
        #region Repository
        $this->app->bind(ILeaderboardRepository::class,LeaderboardRepository::class);
        #endregion
    }
}
