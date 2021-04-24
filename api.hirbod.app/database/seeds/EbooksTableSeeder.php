<?php

use App\Http\Controllers\Account\User;
use App\Http\Controllers\EBook\EBook;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EbooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ebooks')->delete();

        $ebooks=[
            [
                'uuid' => Str::uuid(),
                'user' => User::whereMobile("9142908280")->first()->id,
                'title'=>"first ebook",
                'isbn'=>'0-3452-6575-3',
                'token'=>Str::random(),
                'sample_token'=>Str::random(),
                'created_at'=>now()
            ],
            [
                'uuid' => Str::uuid(),
                'user' => User::whereMobile('9142908280')->first()->id,
                'title'=>"second ebook",
                'isbn'=>'0-8769-5783-3',
                'token'=>Str::random(),
                'sample_token'=>Str::random(),
                'created_at'=>now()
            ],
            [
                'uuid' => Str::uuid(),
                'user' => User::whereMobile('9142908280')->first()->id,
                'title'=>"third ebook",
                'isbn'=>'0-1234-2345-3',
                'token'=>Str::random(),
                'sample_token'=>Str::random(),
                'created_at'=>now()
            ]


        ];
        Ebook::insert($ebooks);
    }
}
