<?php

use App\Enums\User\UserRole;
use App\Http\Controllers\Account\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $users=[
            [
                'uuid' => Str::uuid(),
                'mobile' => '9142908280',
                'country' => '+98',
                'name'=>'Milad Shahi',
                'username'=>'shahi',
                'email'=>'shahi@gmail.com',
                'code'=>generateCode(),
                'code_expire'=>now()->addMinutes(2),
                'password'=>Hash::make('secret'),
                'blue' => true,
                'role' => UserRole::SuperAdmin,
                'created_at'=>now()
            ],
            [
                'uuid' => Str::uuid(),
                'mobile' => '9191150933',
                'country' => '+98',
                'name'=>'Mehrnosh Aghelifar',
                'username'=>'aghelifar',
                'email'=>'aghelifar@gmail.com',
                'code'=>generateCode(),
                'code_expire'=>now()->addMinutes(2),
                'password'=>Hash::make('secret'),
                'blue' => true,
                'role' => UserRole::SuperAdmin,
                'created_at'=>now()
            ],
            [
                'uuid' => Str::uuid(),
                'mobile' => '9371816452',
                'country' => '+98',
                'name'=>'Mohamad Nateghi',
                'username'=>'Nateghi',
                'email'=>'nateghi@gmail.com',
                'code'=>generateCode(),
                'code_expire'=>now()->addMinutes(2),
                'password'=>Hash::make('secret'),
                'blue' => true,
                'role' => UserRole::SuperAdmin,
                'created_at'=>now()
            ],

        ];
        User::insert($users);
    }
}
