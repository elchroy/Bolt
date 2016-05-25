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

        factory('Bolt\User', 50)->create();

        factory('Bolt\Video', 50)->create();

        factory('Bolt\Category', 40)->create();

        factory('Bolt\Comment', 50)->create();

        factory('Bolt\Favorite', 50)->create();

        Model::reguard();
    }
}
