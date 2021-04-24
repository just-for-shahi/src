<?php

namespace Services\Support\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Support\Repositories as Rep;

#endregion

/**
 * Support
 * @author Sajadweb
 * Mon Dec 14 2020 13:48:06 GMT+0330 (Iran Standard Time)
 */
class SupportProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/SupportHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        #endregion
        Route::middleware('api')
            ->prefix('api')
            ->namespace('Services\Support\Controllers')
            ->group(base_path('services/Support/Routes/api.php'));
        #region Repository
        $this->app->bind(Rep\ICallRequestRepository::class, Rep\CallRequestRepository::class);
        $this->app->bind(Rep\IFaqRepository::class, Rep\FaqRepository::class);
        $this->app->bind(Rep\IReplyRepository::class, Rep\ReplyRepository::class);
        $this->app->bind(Rep\ITicketRepository::class, Rep\TicketRepository::class);
        $this->app->bind(Rep\ITicketMapperRepository::class, Rep\TicketMapperRepository::class);
        $this->app->bind(Rep\ITicketAccountRepository::class, Rep\TicketAccountRepository::class);
        #endregion
    }
}
