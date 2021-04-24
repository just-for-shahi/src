<?php

use App\Http\Controllers\Course\Course;
use App\Http\Controllers\EBook\EBook;
use App\Http\Controllers\Podcast\Podcast;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorizables')->delete();
        $taggable=[
            [
                'category_id' => Category::whereType(1)->first()->id,
                'categorizable_type' => get_class(EBook::first()),
                'categorizable_id' => EBook::first()->id,
                'created_at'=>now()
            ],
            [
                'category_id' => Category::whereType(2)->first()->id,
                'categorizable_type' => get_class(Podcast::first()),
                'categorizable_id' => Podcast::first()->id,
                'created_at'=>now()
            ],
            [
                'category_id' => Category::whereType(0)->first()->id,
                'categorizable_type' => get_class(Course::first()),
                'categorizable_id' => Course::first()->id,
                'created_at'=>now()
            ]
        ];
        DB::table('categorizables')->insert($taggable);
    }
}
