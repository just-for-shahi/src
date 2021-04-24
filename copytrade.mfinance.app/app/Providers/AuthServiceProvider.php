<?php

namespace App\Providers;

use App\Impersonate;
use Illuminate\Support\Facades\Auth;
use App\Services\Auth\TrustedHostGuard;
use App\Providers\TrustedHostUserProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('trusted_host_user', function ($app, array $config) {
            return new TrustedHostUserProvider($app->make($config['model']));
        });

        Auth::extend('trusted_host', function ($app, $name, array $config) {
            return new TrustedHostGuard(Auth::createUserProvider($config['provider']), $app->make('request'));
        });
    }

    public function register()
    {
        $this->app->singleton('impersonate', function () {
            return $this->app->make(Impersonate::class);
        });
    }
}
