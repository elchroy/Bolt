<?php

class CommentTest extends TestCase
{
    /**
     * Constant. Return string of an AJAX call to edit a comment.
     */
    const AJAX_EDIT_RETURN = '{"status":"success","time":"3 seconds ago","edited":"| (edited)"}';

    /**
     * Constant. Return string of an AJAX call to delete a comment.
     */
    const AJAX_DELETE_RETURN = '{"status":"success"}';

    public function testCommentVideo()
    {
        $this->createTTModels();
        $comment = Bolt\Comment::find(1);

        $video_id = $comment->video->id;
        $this->assertEquals(1, $video_id);
    }

    public function testCommentCreate()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);
        $this->actingAs($user)
            ->visit('videos/1')
            ->type('This is another comment', 'comment')
            ->press('POST')
            ->seePageIs('videos/1')
            ->see('This is another comment');

        $this->countElements('.comment-text', 2);
    }

    public function testCommentValidationFailsWhenCommentIsTooShort()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);
        $this->actingAs($user)
            ->visit('videos/1')
            ->type('', 'comment')
            ->press('POST')
            ->seePageIs('videos/1')
            ->see('The comment field is required.');

        $this->countElements('.comment-text', 1);
    }

    public function testCommentValidationFailsWhenCommentIsTooLong()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);
        $this->actingAs($user)
            ->visit('videos/1')
            ->type('sdlkfjbnslkdfjbnlks dnflkbjnlsdnfkblksndlkvbn lsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsk', 'comment')
            ->press('POST')
            ->seePageIs('videos/1')
            ->see('The comment may not be greater than 255 characters');

        $this->countElements('.comment-text', 1);
    }

    public function testNumberOfUserComments()
    {
        $this->createTTModels();

        factory(Bolt\Comment::class)->create([
            'user_id' => 1,
        ]);

        $user = Bolt\User::find(1);

        $this->assertEquals(2, $user->comments()->get()->count());
    }

    public function testEditCommentIsSuccessful()
    {
        $this->createTTModels();
        $user = Bolt\User::find(1);

        $this->actingAs($user)->call('PATCH', 'comments/1', ['_token' => csrf_token(), 'comment' => 'This is the updated comment.']);

        $comment = Bolt\Comment::find(1)->comment;
        $this->assertEquals('This is the updated comment.', $comment);
    }

    public function testCommentUpdateFailsWhenThereIsNoAuthenticatedUser()
    {
        $this->createTTModels();

        $this->call('PATCH', 'comments/1', ['_token' => csrf_token(), 'comment' => 'This is the updated comment.']);

        $comment = Bolt\Comment::find(1);

        $this->assertEquals('Very nice introduction to the MS-Dot-Net Framework.', Bolt\Comment::find(1)->comment);
    }

    public function testCommentDestroyIsSuccessful()
    {
        $this->createTTModels();
        $user = Bolt\User::find(1);

        $this->actingAs($user)->call('DELETE', 'comments/1', ['_token' => csrf_token()]);
        $comment = Bolt\Comment::find(1);
        $this->assertEquals(null, $comment);
    }

    public function testTimeAtWhichCommentWasCreated()
    {
        $this->createTTModels();

        $comment = Bolt\Comment::find(1);
        $user = Bolt\User::find(1);

        $this->assertTrue($user == $comment->user);
        $this->assertEquals('1 second ago', $comment->commentedAt());
    }

    public function testCommentAddWithAjax()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);

        $ajaxReturn = $this->actingAs($user)->json('POST', 'videos/1/comments/add', ['comment' => 'This is a new comment.'], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);

        $response = get_object_vars($ajaxReturn)['response'];
        $jsonResponse = $response->content();
        $decoded = json_decode($jsonResponse);

        $this->assertEquals(2, $decoded->id);
        $this->assertEquals('success', $decoded->status);
        $this->assertEquals(200, $response->status());

        $video = Bolt\Video::find(1);

        $this->assertEquals(2, $video->comments()->count());

        $comments = $video->comments->toArray();
        $comment = $comments[1]['comment'];

        $this->assertEquals('This is a new comment.', $comment);
    }

    public function testCommentUpdateWithAjax()
    {
        $this->createTTModels();

        sleep(3);

        $user = Bolt\User::find(1);

        $ajaxReturn = $this->actingAs($user)->json('PATCH', 'comments/1', ['comment' => 'This is the updated comment.'], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);

        $response = get_object_vars($ajaxReturn)['response'];
        $jsonResponse = $response->content();

        $this->assertEquals(SELF::AJAX_EDIT_RETURN, $jsonResponse);

        $this->assertEquals(200, $response->status());

        $video = Bolt\Video::find(1);

        $this->assertEquals(1, $video->comments->count());

        $this->assertEquals('This is the updated comment.', $video->comments->shift()->comment);
    }

    public function testCommentDeleteWithAjax()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);

        $ajaxReturn = $this->actingAs($user)->json('DELETE', 'comments/1', ['comment' => 'This is the updated comment.'], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);

        $response = get_object_vars($ajaxReturn)['response'];
        $jsonResponse = $response->content();

        $this->assertEquals(SELF::AJAX_DELETE_RETURN, $jsonResponse);

        $this->assertEquals(200, $response->status());

        $this->assertEquals(0, Bolt\Video::find(1)->comments()->count());
    }
}
