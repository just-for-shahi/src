<?php

use App\Http\Controllers\Account\User;
use App\Http\Controllers\Event\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->delete();
        $events=[
            [
                'uuid' => Str::uuid(),
                'user' => User::whereMobile("9142908280")->first()->id,
                'title'=>"first event",
                'created_at'=>now()
            ],
            [
                'uuid' => Str::uuid(),
                'user' => User::whereMobile('9142908280')->first()->id,
                'title'=>"second event",
                'created_at'=>now()
            ],
            [
                'uuid' => Str::uuid(),
                'user' => User::whereMobile('9142908280')->first()->id,
                'title'=>"third event",
                'created_at'=>now()
            ]


        ];
        Event::insert($events);
    }
}
