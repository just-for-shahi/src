<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user=$event->user;
        Mail::send('mail.verify',['user'=>$user],function ($message) use ($user){
            $message->from('support@hirbodapp.ir','هیربد');
            $message->subject('کد فعال سازی');
            $message->to($user->email);

        });
    }
}
