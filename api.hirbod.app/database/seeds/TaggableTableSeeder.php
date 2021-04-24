<?php

use App\Http\Controllers\Course\Course;
use App\Http\Controllers\EBook\EBook;
use App\Http\Controllers\Podcast\Podcast;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaggableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('taggables')->delete();
        $taggable=[
            [
                'tag_id' => Tag::first()->id,
                'taggable_type' => get_class(EBook::first()),
                'taggable_id' => EBook::first()->id,
                'created_at'=>now()
            ],
            [
                'tag_id' => Tag::first()->id,
                'taggable_type' => get_class(Podcast::first()),
                'taggable_id' => Podcast::first()->id,
                'created_at'=>now()
            ],
            [
                'tag_id' => Tag::first()->id,
                'taggable_type' => get_class(Course::first()),
                'taggable_id' => Course::first()->id,
                'created_at'=>now()
            ]
        ];
        DB::table('taggables')->insert($taggable);
    }
}
