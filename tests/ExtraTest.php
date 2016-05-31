<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExtraTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testModelAvailabilityMiddleWare()
    {
    	$this->createTTModels();

    	$user = Bolt\User::find(1);

    	$this->actingAs($user)
    			->visit('videos/1200')
    			->see(404)
    			;

    }
}
