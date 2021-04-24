<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
          [
              'uuid' => Str::uuid(),
              'name' => 'vahiid',
              'mobile' => '9304708510',
              'country' => '98',
              'role' => '1'
          ],
           [
               'uuid' => Str::uuid(),
               'name' => 'sajad',
               'mobile' => '9332369461',
               'country' => '98',
               'role' => '1'
           ]
        ];
        DB::table('users')->insert($data);
    }
}
