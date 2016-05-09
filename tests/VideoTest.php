<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VideoTest extends TestCase
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

    public function testVideoIndex()
    {
    	$category = $this->createCategory();
    	$this->visit('/videos')
    		->seePageIs('videos');
    		// ->see('MsDotNet');
    }

    public function testVideoShowWithoutAuthUser()
    {
    	$this->createVideo();
    	$this->visit('videos/1')
                // ->see('roy')
    			// ->see('A Introduction to MsDotNet')
    			;	
        // $this->countElements('.video-user', 1);
    }
}
