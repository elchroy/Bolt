<?php


class VideoTest extends TestCase
{

    const AJAX_VIDEO_FAV = '{"status":"success","message":"Done"}';

    const AJAX_VIDEO_UNFAV = '{"status":"success","message":"Done"}';

    public function testVideoIndexViewForAllVideos()
    {
        $this->createTTModels();

        $this->visit('/videos')
            ->seePageIs('videos')
            ->see('MsDotNet');
    }

    public function testVideoShowWithoutAuthUser()
    {
        $this->createVideo();
        $this->visit('videos/1')
            ->see('roy')
            ->see('MsDotNet')
            ->see('A Introduction to MsDotNet');

        $this->countElements('.video-user', 1);
    }

    public function testAddVideoLinkFailsForNoAuthenticatedUser()
    {
        $this->visit('videos/add')->seePageIs('login');
    }

    public function testAddVideoSucceeds()
    {
        $user = $this->createUser();
        $this->createCategory();
        $this->actingAs($user)
            ->visit('videos/add')
            ->seePageIs('videos/add')
            ->type('A new title', 'title')
            ->type('https://www.youtube.com/watch?v=3oT9PQcFZKc', 'url')
            ->type('A new description', 'description')
            ->select(1, 'category_id')
            ->press('Add')
            ->seePageIs('dashboard')
            ->see('A new title');
    }

    public function testAddVideoValidatorFailsForEmptyFields()
    {
        $user = $this->createUser();
        $this->createCategory();
        $this->actingAs($user)
            ->visit('videos/add')
            ->seePageIs('videos/add')
            ->type('', 'title')
            ->type('', 'url')
            ->type('', 'description')
            ->select('', 'category_id')
            ->press('Add')
            ->seePageIs('videos/add')
            ->see('The description field is required.')
            ->see('The category id field is required.')
            ->see('The url field is required.');
    }

    public function testVideoEditPage()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);

        $this->actingAs($user)
            ->visit('videos/1/edit')
            ->see('A Introduction to MsDotNet')
            ->see('This is an introduction to the Microsoft DotNet Framework. It is very powerful.')
            ->type('This is the updated description.', 'description')
            ->select(1, 'category_id')
            ->see('Save')
            ->press('Save')
            ->seePageIs('dashboard');

        $this->assertEquals('This is the updated description.', Bolt\Video::find(1)->description);
    }

    public function testEditVideoLinkFailsForNoAuth()
    {
        $this->visit('videos/1/edit')->seePageIs('login');
    }

    public function testEditVideoLinkFailsForWrongOwner()
    {
        $this->createTTModels();
        factory(Bolt\User::class)->create(['id' => 100]);

        $user = Bolt\User::find(100);

        $this->actingAs($user)
            ->visit('videos/1/edit')
            ->seePageIs('dashboard');
    }

    public function testVideoDeleteIsSuccessful()
    {
        $this->createTTModels();
        $video = Bolt\Video::find(1);
        $this->createFavoriteFor($video);

        $user = Bolt\User::find(1);
        
        $this->actingAs($user)
            ->visit('videos/1/edit')
            ->press('submit-delete-form')
            ->seePageIs('dashboard')
            ->see('Video Deleted');

        $this->countElements('.delete_video', 0);
        $video = Bolt\Video::find(1);
        $this->assertEquals(null, $video);
    }

    public function testVideoSearch()
    {
        $this->createVideo();
        $response = $this->call('GET', 'videos/search', ['search' => 'Introdu']);

        $this->visit('/videos')
            ->type('Introdu', 'search')
            ->press("submit-search")
            ->seePageIs('/videos/search?search=Introdu')
            ->see('Introduction to MsDotNet')
;
        $this->assertEquals(200, $response->status());
    }

    public function testVideoLike()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);
        $video = Bolt\Video::find(1);
        $this->actingAs($user)
            ->visit('videos/1')
            ->see('Like')
            ->press('button-favorite')
            ->seePageIs('videos/1')
            ->see('Unfavorite');
        
        $this->assertEquals(1, $user->favors($video));
    }

    public function testVideoUnLike()
    {
        $video = $this->createVideo();
        $favorite = $this->createFavoriteFor($video);

        $user = Bolt\User::find(1);
        $video = Bolt\Video::find(1);
        $this->actingAs($user)
            ->visit('videos/1')
            ->press('button-unfavorite')
            ->seePageIs('videos/1')
            ->see('Like');

        $this->assertEquals(0, $user->favors($video));
    }

    public function testVideoFavoriteWithAjax()
    {
        $this->createTTModels();
        $video = Bolt\Video::find(1);

        $user = Bolt\User::find(1);

        $ajaxReturn = $this->actingAs($user)->json('POST', 'videos/1/favorite', [], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $response = get_object_vars($ajaxReturn)['response'];

        $jsonResponse = $response->content();

        $this->assertEquals( SELF::AJAX_VIDEO_FAV , $jsonResponse);
        $this->assertEquals(200, $response->status());

        $status = Bolt\Favorite::find(1)->status;
        
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

        $this->assertEquals(SELF::AJAX_VIDEO_UNFAV, $jsonResponse);
        $this->assertEquals(200, $response->status());

        $status = Bolt\Favorite::find(1)->status;
        
        $this->assertEquals(0, $status);
        $this->assertTrue(0 == $status);
    }

    public function testVideoCheckFails()
    {
        $response = $this->visit('check?url=invalid');
        $return = $response->response->content();

        $this->assertEquals('not found', $return);
    }

    public function testVideoCheckPasses()
    {
        $response = $this->visit('check?url=https://www.youtube.com/watch?v=RBIJlgIg_w0');
        $return = $response->response->content();

        $this->assertEquals('found', $return);
    }
}
