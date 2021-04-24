<?php

namespace App\Providers;

use App\Http\Controllers\Account\Account;
use App\Http\Controllers\CallRequest\CallRequest;
use App\Http\Controllers\Ticket\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Petstore30\User;

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

//        Gate::before(static function(){
//            if (user()->is_admin){
//                return true;
//            }
//        });

        \Gate::define('access-ticket', static function (Account $user, Ticket $ticket) {
            return $ticket->ticket_account->account_id == $user->id;
        });

        \Gate::define('access-call-request', static function (Account $account, CallRequest $callRequest) {
            return $callRequest->account_id == $account->id;
        });

        \Gate::define('access-entity', static function (Account $account, Model $entity) {
            if (isset($entity->account_id)) {
                return $account->id == $entity->account_id;
            }

            throw new \RuntimeException('account_id is not set on ' . class_basename($entity));
        });
    }
}
