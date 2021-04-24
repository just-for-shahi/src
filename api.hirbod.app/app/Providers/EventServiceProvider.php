<?php

namespace App\Providers;

use App\Events\Email;
use App\Events\Pdf;
use App\Events\SearchEvent;
use App\Listeners\SearchListener;
use App\Listeners\SendEmail;
use App\Listeners\UploadPdf;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class
        ],
        SearchEvent::class=>[
            SearchListener::class
        ],
        Email::class=>[
            SendEmail::class
        ],
        Pdf::class=>[
            UploadPdf::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
