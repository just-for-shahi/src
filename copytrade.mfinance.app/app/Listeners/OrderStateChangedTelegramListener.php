<?php

namespace App\Listeners;

use App\Helpers\BladeHelper;

use App\Events\OrderStateChanged;
use Illuminate\Support\Facades\Log;
use App\Models\TelegramSubscription;
use NotificationChannels\Telegram\Telegram;
use NotificationChannels\Telegram\TelegramMessage;

class OrderStateChangedTelegramListener
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

            $items = TelegramSubscription::
                with('sources')->
                whereHas('sources', function ($query) use($account_id) { $query->where('account_id', $account_id);})->
                get();

            foreach ($items as $item) {
                $message = null;

                switch($orderObject->status) {
                    case 1: $template = $item->template_signal_new; break;
                    case 2: $template = $item->template_signal_updated; break;
                    case 3:
                        if($orderObject->pl > 0)
                            $template = $item->template_signal_closed_profit;
                        if($orderObject->pl < 0)
                            $template = $item->template_signal_closed_lost;
                        if($orderObject->pl == 0)
                            $template = $item->template_signal_closed_breakeven;
                    break;
                    case 4: $template = $item->template_signal_canceled; break;
                }

                if(empty($template))
                    continue;

                try {
                    $orderObject->subscription_title = $item->title;
                    $orderObject->source_title = $item->sources()->first()->title;
                    $message = BladeHelper::bladeCompile( $template, (array)$orderObject);

                } catch (\Exception $e) {
                    echo $e->getMessage();
                    Log::error($e);
                    continue;
                }

                if(\strlen($message) < 4)
                    continue;

                $telegramMessage = TelegramMessage::create($message);

                $telegram = new Telegram($item->bot_api_token);

                $telegramMessage = $telegramMessage->to($item->channel_id)->toArray();

                $telegram->sendMessage($telegramMessage);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            Log::error($e);
        }
    }
}
