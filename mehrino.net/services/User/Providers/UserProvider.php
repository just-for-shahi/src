<?php

namespace Services\User\Providers;

#region use
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Services\User\Repositories\AutoMapperRepository;
use Services\User\Repositories\EmailRepository;
use Services\User\Repositories\IAutoMapperRepository;
use Services\User\Repositories\IEmailRepository;
use Services\User\Repositories\ISmsRepository;
use Services\User\Repositories\IUserRepository;
use Services\User\Repositories\SmsRepository;
use Services\User\Repositories\UserRepository;
#endregion

/**
 * User
 * @author Sajadweb
 * Mon Dec 07 2020 23:16:28 GMT+0330 (Iran Standard Time)
 */
class UserProvider extends ServiceProvider
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
        require_once __DIR__ . "/../Helpers/UserHelper.php";
        #endregion
        #region Migrations
        $this->loadMigrationsFrom( __DIR__ . '/../Migrations');
        #endregion
        Route::middleware('web')
            ->namespace('Services\User\Controllers')
            ->group(base_path('services/User/Routes/web.php'));

        Route::middleware('api')
                ->prefix('api')
                ->namespace('Services\User\Controllers')
                ->group(base_path('services/User/Routes/api.php'));
        #region Repository
        $this->app->bind(IUserRepository::class,UserRepository::class);
        $this->app->bind( ISmsRepository::class,SmsRepository::class);
        $this->app->bind( IEmailRepository::class,EmailRepository::class);
        $this->app->bind( IAutoMapperRepository::class,AutoMapperRepository::class);
        #endregion
    }
}
