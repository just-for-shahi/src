<?php

use App\Http\Controllers\Support\Faq;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FaqsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faqs')->delete();
        $faqs=[
            [
                'uuid' => Str::uuid(),
                'title' =>'آیا با اکانت ایمیل هم میشود وارد شد؟',
                'content'=>"خیر با شماره موبایل فقط میتوانید وارد برنامه شوید"
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'آیا امکان تبدیل کردن موجودی به واحد های پولی دیگه هست؟',
                'content'=>"خیر واحد پولی ریال است"
            ]

        ];
        Faq::insert($faqs);
    }
}
