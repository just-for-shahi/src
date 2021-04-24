<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Gate::before(static function () {
            if (user()->is_admin) {
                return true;
            }
        });

        \Gate::define('access-entity', static function (Model $entity) {
            if (isset($entity->user_id)) {
                return $entity->user_id == auth()->id();
            }

            throw new \RuntimeException('user_id is not set on ' . class_basename($entity));
        });
    }
}
