<?php

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        $now = Carbon::now();
        $categories= [
            [
                'uuid' => Str::uuid(),
                'name' => 'مدیریت و کارآفرینی',
                'type' => 0,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'شعر و ادبیات',
                'type' => 0,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'سلامت و سبک زندگی',
                'type' => 0,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'سرگرمی و کمدی',
                'type' => 0,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'زبان‌های خارجی',
                'type' => 0,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'ادیان و تاریخ',
                'type' => 0,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'علم و تکنولوژی',
                'type' => 0,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'ورزش',
                'type' => 0,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'هنر و طراحی',
                'type' => 0,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'گردشگری',
                'type' => 0,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'جامعه و رواشناسی',
                'type' => 0,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'موسیقی و نوا',
                'type' => 0,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'مدرسه و دانشگاه',
                'type' => 0,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'موفقیت و ثروت',
                'type' => 0,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'توسعه فردی',
                'type' => 0,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'داستان و رمان',
                'type' => 1,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'روانشناسی',
                'type' => 1,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'رایگان',
                'type' => 1,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'مجلات',
                'type' => 1,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'میکروکتاب',
                'type' => 1,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'تبلیغات و بازاریابی',
                'type' => 1,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'آموزش',
                'type' => 1,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'اسطوره',
                'type' => 1,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'اقتصاد',
                'type' => 1,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'تاریخ',
                'type' => 1,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'حقوق',
                'type' => 1,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'دین و عرفان',
                'type' => 1,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'زنان و فمینیسم',
                'type' => 1,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'سبک زندگی',
                'type' => 1,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'علوم اجتماعی',
                'type' => 1,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'فلسفه',
                'type' => 1,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'کودک',
                'type' => 1,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'نوجوان',
                'type' => 1,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'هنر',
                'type' => 1,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'آموزش',
                'type' => 2,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'ادیان و مذاهب',
                'type' => 2,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'بازی‌های رایانه‌ای',
                'type' => 2,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'تاریخ',
                'type' => 2,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'تکنولوژی',
                'type' => 2,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'جامعه',
                'type' => 2,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'خبر',
                'type' => 2,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'داستان',
                'type' => 2,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'روانشناسی',
                'type' => 2,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'سبک زندگی',
                'type' => 2,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'سرگرمی',
                'type' => 2,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'سلامت',
                'type' => 2,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'سینما',
                'type' => 2,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'صدای محیط',
                'type' => 2,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'علم',
                'type' => 2,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'موسیقی',
                'type' => 2,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'هنر',
                'type' => 2,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'کسب و کار',
                'type' => 2,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'گردشگری',
                'type' => 2,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'تکنولوژی',
                'type' => 3,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'کارآفرینی',
                'type' => 3,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'فرهنگی هنری',
                'type' => 3,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'گردشگری',
                'type' => 3,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'مدیریت',
                'type' => 3,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'کسب و کار',
                'type' => 3,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'فنی، مهندسی و صنعت',
                'type' => 3,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'خیریه',
                'type' => 3,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'مذهبی و مناسبتی',
                'type' => 3,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'پزشکی و سلامت',
                'type' => 3,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'مالی',
                'type' => 3,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'توسعه فردی و خانواده',
                'type' => 3,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'تحصیلی و آموزشی',
                'type' => 3,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'ورزشی',
                'type' => 3,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'سرگرمی',
                'type' => 3,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'علوم انسانی',
                'type' => 3,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'علوم پایه',
                'type' => 3,
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'سایر',
                'type' => 3,
                'created_at' => $now
            ]
        ];
        Category::insert($categories);
    }
}
