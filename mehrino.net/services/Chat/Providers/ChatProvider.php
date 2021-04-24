<?php

namespace Services\Chat\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Chat\Repositories\IChatRepository;
use Services\Chat\Repositories\ChatRepository;
#endregion

/**
 * Chat
 * @author Sajadweb
 * Sun Dec 27 2020 13:55:03 GMT+0330 (Iran Standard Time)
 */
class ChatProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/ChatHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\Chat\Controllers')
                ->group(base_path('services/Chat/Routes/api.php'));
        #region Repository
        $this->app->bind(IChatRepository::class,ChatRepository::class);
        #endregion
    }
}
