<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(
             [
                 CategoryTableSeeder::class,
                 UsersTableSeeder::class,
                 FaqsTableSeeder::class,
                 EbooksTableSeeder::class,
                 PodcastsTableSeeder::class,
                 CoursesTableSeeder::class,
                 EventsTableSeeder::class,
                 TransactionsTableSeeder::class,
                 TagsTableSeeder::class,
                 TaggableTableSeeder::class,
                 CategoriableTableSeeder::class
             ]);
    }
}
