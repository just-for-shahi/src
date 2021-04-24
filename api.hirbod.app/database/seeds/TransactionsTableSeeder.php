<?php

use App\Http\Controllers\Account\User;
use App\Http\Controllers\EBook\EBook;
use App\Http\Controllers\Finance\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->delete();
        $transactions=[
            [
                'uuid' => Str::uuid(),
                'user' => User::whereMobile('9142908280')->first()->id,
                'amount'=>'2000',
                'authority'=> Str::random(),
                'status'=>1,
                'transactional_type'=>EBook::class,
                'transactional_id'=>EBook::whereIsbn('0-3452-6575-3')->first()->id,
                'created_at'=>now()
            ],
            [
                'uuid' => Str::uuid(),
                'user' => User::whereMobile('9142908280')->first()->id,
                'amount'=>'2000',
                'authority'=> Str::random(),
                'status'=>1,
                'transactional_type'=>EBook::class,
                'transactional_id'=>EBook::whereIsbn('0-3452-6575-3')->first()->id,
                'created_at'=>now()
            ]

        ];
      Transaction::insert($transactions);
    }
}
