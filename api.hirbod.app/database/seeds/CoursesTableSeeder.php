<?php

use App\Http\Controllers\Account\User;
use App\Http\Controllers\Course\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->delete();

        $courses=[
            [
                'uuid' => Str::uuid(),
                'user' => User::whereMobile("9142908280")->first()->id,
                'title'=>"first course",
                'cover' => Str::random(),
                'created_at'=>now()
            ],
            [
                'uuid' => Str::uuid(),
                'user' => User::whereMobile('9142908280')->first()->id,
                'title'=>"second course",
                'cover' => Str::random(),
                'created_at'=>now()
            ],
            [
                'uuid' => Str::uuid(),
                'user' => User::whereMobile('9142908280')->first()->id,
                'title'=>"third course",
                'cover' => Str::random(),
                'created_at'=>now()
            ]


        ];
        Course::insert($courses);
    }
}
