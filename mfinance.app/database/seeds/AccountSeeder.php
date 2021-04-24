<?php

use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Http\Controllers\Account\Account::create([
            'id' => 1916628,
            'first_name' => 'Milad',
            'last_name' => 'Shahi Shavoun',
            'email' => 'aznadesign@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('secret'),
            'status' => \App\Enums\Account\Status::VERIFIED,
            'role' => \App\Enums\Account\Role::ADMIN
        ]);
    }
}
