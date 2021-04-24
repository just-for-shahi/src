<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
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
        $now = Carbon::now();
        $categories = [
            [
                'uuid' => Str::uuid(),
                'title' => 'حیوانات',
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'هنر و فرهنگ',
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'کودک',
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'انجمن',
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'تحصیلات',
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'کمک‌های اضطراری',
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'کارآفرینی',
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'رویداد',
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'مراسم خاکسپاری',
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'سلامت و بهداشت',
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'مسکن',
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'حقوق بشر',
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'گرسنگی',
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'طبیعت و محیط‌زیست',
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'پناهندگان',
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'دین',
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'ورزش',
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'عروسی',
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'توانمندسازی زنان',
                'created_at' => $now
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'دیگر',
                'created_at' => $now
            ],
        ];
        Category::insert($categories);
    }
}
