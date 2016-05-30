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

    public function testAddVideoLinkFailsForNoAuth()
    {
        $page = $this->visit('videos/add')
                    ->seePageIs('login')
                    ;
    }

    public function testAddVideoSucceeds()
    {
        $user = $this->createUser();
        $category = $this->createCategory();
        $page = $this->actingAs($user)
                    ->visit('videos/add')
                    ->seePageIs('videos/add')
                    ->type('A new title', 'title')
                    ->type('https://www.youtube.com/watch?v=3oT9PQcFZKc', 'url')
                    ->type('A new description', 'description')
                    ->select(1, 'category_id')
                    ->press('Add')
                    ->seePageIs('dashboard')
                    // ->see('A new title')
                    ;
    }

    public function testAddVideoValidatorFails()
    {
        $user = $this->createUser();
        $category = $this->createCategory();
        $page = $this->actingAs($user)
                    ->visit('videos/add')
                    ->seePageIs('videos/add')
                    ->type('', 'title')
                    ->type('', 'url')
                    ->type('', 'description')
                    ->select('', 'category_id')
                    ->press('Add')
                    ->seePageIs('videos/add')
                    // ->see('A new title')
                    ;
    }

    public function testVideoEditPage()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);
        $page = $this->actingAs($user)
                ->visit('videos/1/edit')
                ->see('A Introduction to MsDotNet')
                ->see('This is an introduction to the Microsoft DotNet Framework. It is very powerful.')
                ->type('This is the updated description.', 'description')
                ->select(1, 'category_id')
                ->see('Save')
                ->press('Save')
                ->seePageIs('dashboard')
                ;
        $video = Bolt\Video::find(1);
        $this->assertEquals('This is the updated description.', $video->description);
    }

    public function testEditVideoLinkFailsForNoAuth()
    {
        $page = $this->visit('videos/1/edit')
                    ->seePageIs('login')
                    ;
    }

    public function testEditVideoLinkFailsForWrongOwner()
    {
    	$this->createTTModels();

    	factory(Bolt\User::class)->create([
            'id'   => 100,
        ]);

        $user = Bolt\User::find(100);

        $page = $this->actingAs($user)
        			->visit('videos/1/edit')
                    ->seePageIs('dashboard')
                    ;
    }

    public function testVideoDelete()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);
        $page = $this->actingAs($user)
                ->visit('videos/1/edit')
                ->press('submit-delete-form')
                ->seePageIs('dashboard')
                ->see('Video Deleted')
                ;

        // $this->assertSessionHas('success', 'Please Login.');
        $this->countElements('.delete_video', 0);
        $video = Bolt\Video::find(1);
        $this->assertEquals(null, $video);
    }

    public function testVideoSearch()
    {
        $this->createVideo();
        $response = $this->call('GET', 'videos/search', ['search' => 'Introdu'])

        // $this->visit('/videos')
                // ->type('Introdu', 'search')
                // ->press("Search")
                // ->seePageIs('/videos')
                // ->see()
                ;
        $this->assertEquals(200, $response->status());
    }

    public function testVideoLike()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);
        $video = Bolt\Video::find(1);
        $page = $this->actingAs($user)
                ->visit('videos/1')
                ->see('Like')
                ->press('button-favorite')
                ->seePageIs('videos/1')
                ->see('Unfavorite')
                ;
        $status = $user->favors($video);
        $this->assertEquals(1, $status);
    }

    public function testVideoUnLike()
    {
        $video = $this->createVideo();
        $favorite = $this->createFavoriteFor($video);

        $user = Bolt\User::find(1);
        $video = Bolt\Video::find(1);
        $page = $this->actingAs($user)
                ->visit('videos/1')
                // ->see('Unlike')
                ->press('button-unfavorite')
                ->seePageIs('videos/1')
                ->see('Like')
                ;
        $status = $user->favors($video);
        $this->assertEquals(0, $status);
    }

    public function testVideoFavoriteWithAjax()
    {
        $this->createTTModels();
        $video = Bolt\Video::find(1);

        $user = Bolt\User::find(1);

        $ajaxReturn = $this->actingAs($user)->json('POST', 'videos/1/favorite', [], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $response = get_object_vars($ajaxReturn)['response'];

        $jsonResponse = $response->content();

        $this->assertEquals('{"status":"success","message":"Done"}', $jsonResponse);
        $this->assertEquals(200, $response->status());

        $favorite = Bolt\Favorite::find(1);
        $status = $favorite->status;
        $this->assertEquals(1, $status);
        $this->assertTrue(1 == $status);
    }

    public function testVideoUnfavoriteWithAjax()
    {
        $this->createTTModels();
        $video = Bolt\Video::find(1);
        $this->createFavoriteFor($video);

        $user = Bolt\User::find(1);

        $ajaxReturn = $this->actingAs($user)->json('POST', 'videos/1/unfavorite', [], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $response = get_object_vars($ajaxReturn)['response'];

        $jsonResponse = $response->content();

        $this->assertEquals('{"status":"success","message":"Done"}', $jsonResponse);
        $this->assertEquals(200, $response->status());

        $favorite = Bolt\Favorite::find(1);
        $status = $favorite->status;
        $this->assertEquals(0, $status);
        $this->assertTrue(0 == $status);
    }
}
