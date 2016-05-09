<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        factory('Bolt\User', 5)->create();

        factory('Bolt\Video', 5)->create();

        factory('Bolt\Category', 4)->create();

        Model::reguard();
    }
}
