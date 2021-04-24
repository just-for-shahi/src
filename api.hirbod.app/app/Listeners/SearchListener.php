<?php

namespace App\Listeners;

use App\Events\SearchEvent;
use App\Http\Controllers\Search;

class SearchListener
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
     * @param  SearchEvent  $event
     * @return void
     */
    public function handle(SearchEvent $event)
    {

        if(is_null(Search::whereQ(trim($event->search))->first())){
            Search::create([
                'q'=>$event->search,
                'user'=>auth('api')->user()->id
            ]);

        }
        $search=Search::whereQ(trim($event->search))->first();
        $newCount=$search->count + 1;
        Search::whereQ(trim($event->search))->first()->update(['count'=>$newCount]);

    }
}
