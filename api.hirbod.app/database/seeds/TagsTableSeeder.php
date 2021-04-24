<?php

use App\Http\Controllers\Account\User;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->delete();
        $tags=[
            [
                'uuid' => Str::uuid(),
                'name'=>'tag-1',
                'color'=> 'red',
                'created_at'=>now()
            ],
            [
                'uuid' => Str::uuid(),
                'name'=>'tag-2',
                'color'=> 'green',
                'created_at'=>now()
            ],
            [
                'uuid' => Str::uuid(),
                'name'=>'tag-3',
                'color'=> 'yellow',
                'created_at'=>now()
            ],
        ];
        Tag::insert($tags);
    }
}
