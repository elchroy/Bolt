<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('Bolt\User', 5)->create();

        // $this->call(UsersTableSeeder::class);
    }
}
