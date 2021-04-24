<?php

use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branches = [
            [
                'id' => 4234,
                'uuid' => \Illuminate\Support\Str::uuid(),
                'code' => 00000,
                'account_id' => 1916628,
                'name' => 'My Uinvest',
                'open' => now(),
                'country' => 'TR',
                'province' => 'Tehran',
                'city' => 'Tehran',
                'phone' => '02122458190',
                'services' => \App\Enums\Branch\Service::HODHOD,
                'status' => \App\Enums\Branch\Status::ACTIVE,
            ],
            [
                'id' => 65422,
                'uuid' => \Illuminate\Support\Str::uuid(),
                'code' => 00001,
                'account_id' => 1916628,
                'name' => 'Tehran-003(Artesh blvd)',
                'open' => now(),
                'country' => 'IR',
                'province' => 'Tehran',
                'city' => 'Tehran',
                'phone' => '02122458190',
                'services' => \App\Enums\Branch\Service::HODHOD,
                'status' => \App\Enums\Branch\Status::ACTIVE,
            ]
        ];
        \App\UModels\Branch::insert($branches);
    }
}
