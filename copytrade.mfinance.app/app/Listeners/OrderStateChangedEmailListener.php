<?php

namespace App\Listeners;

use App\Events\OrderStateChanged;

use App\Helpers\BladeHelper;
use App\Mail\OrderSignalEmail;
use App\Models\EmailSubscription;
use App\Models\UserEmailSubscription;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderStateChangedEmailListener
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

    public function handle(OrderStateChanged $event)
    {
        try {
            $orderObject = $event->order;

            if ($orderObject->live_time > 60) {
                return;
            }

            $account_id = $orderObject->account_id;

            $subscriptions = EmailSubscription::with('sources')->whereHas('sources', static function($q) use ($account_id) { $q->whereAccountId($account_id); })->get();

            foreach($subscriptions as $subscription) {
                $emailObject = null;
                $orderObject->subscription_title = $subscription->title;
                $orderObject->source_title = $subscription->sources()->first()->title;

                switch($orderObject->status) {
                    case 1: $template = $subscription->template_signal_new; break;
                    case 2: $template = $subscription->template_signal_updated; break;
                    case 3: $template = $subscription->template_signal_closed; break;
                }

                if(empty($template))
                    continue;

                $emailObject = OrderSignalEmail::create($subscription->title, (array)$orderObject, $template);

                $subscribers = UserEmailSubscription::
                    where('email_subscription_id', $subscription->id)->
                    get();

                foreach ($subscribers as $subscriber) {
                    \Mail::to($subscriber->email)->send($emailObject);
                }

            }

        } catch (\Exception $e) {
            echo $e->getMessage();
            Log::error($e);
        }

    }

}
