<?php

namespace Services\Email\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\Email\Repositories\IEmailRepository;
use Services\Email\Repositories\EmailRepository;
#endregion

/**
 * Email
 * @author Sajadweb
 * Tue Jan 05 2021 23:17:01 GMT+0330 (Iran Standard Time)
 */
class EmailProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../Views', 'mail');
    }
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #region Helper
        require_once __DIR__ . "/../Helpers/EmailHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion

        #region Repository
        $this->app->bind(IEmailRepository::class,EmailRepository::class);
        #endregion
    }
}
