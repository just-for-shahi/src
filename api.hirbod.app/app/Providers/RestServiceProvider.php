<?php

namespace App\Providers;

use App\Facades\Rest\Rest;
use Illuminate\Support\ServiceProvider;

class RestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Rest',function (){
            return new Rest();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
