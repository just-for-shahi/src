<?php

use App\Http\Controllers\Account\User;
use App\Http\Controllers\Podcast\Podcast;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PodcastsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('podcasts')->delete();

        $podcasts=[
            [
                'uuid' => Str::uuid(),
                'user' => User::whereMobile("9142908280")->first()->id,
                'title'=>"first podcast",
                'created_at'=>now()
            ],
            [
                'uuid' => Str::uuid(),
                'user' => User::whereMobile('9142908280')->first()->id,
                'title'=>"second podcast",
                'created_at'=>now()
            ],
            [
                'uuid' => Str::uuid(),
                'user' => User::whereMobile('9142908280')->first()->id,
                'title'=>"third podcast",
                'created_at'=>now()
            ]


        ];
        Podcast::insert($podcasts);
    }
}
