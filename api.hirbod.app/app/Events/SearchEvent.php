<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SearchEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $search;

    /**
     * Create a new event instance.
     *
     * @param $search
     */
    public function __construct($search)
    {
        $this->search=$search;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('search');
    }
}
