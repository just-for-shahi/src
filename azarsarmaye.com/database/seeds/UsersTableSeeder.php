<?php

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'id' => 403875,
            'uuid' => \Illuminate\Support\Str::uuid(),
            'first_name' => 'Milad',
            'last_name' => 'Shahi',
            'username' => 'milad',
            'email' => 'aznadesign@gmail.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'mobile' => '09142908280',
            'code' => '191662',
            'captain' => null,
            'team' => 0,
            'password' => \Illuminate\Support\Facades\Hash::make('secret'),
            'role' => 6,
            'status' => 1,
            'identity_no' => '1610337662',
            'identity_card_front' => null,
            'identity_card_back' => null,
            'created_at' => \Carbon\Carbon::now()
        ]);
        Account::create([
            'user_id' => 403875,
            'uuid' => \Illuminate\Support\Str::uuid(),
            'no' => \App\Helpers\AccountHelper::no(),
            'name' => 'پیشفرض',
            'color' => 0,
            'balance' => 1045000,
            'growth' => 45000,
            'harvestable' => 45000,
            'status' => 0
        ]);
    }
}
