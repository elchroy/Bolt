<?php


class CommentTest extends TestCase
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
        $page = $this->actingAs($user)
                ->visit('videos/1')
                ->type('This is another comment', 'comment')
                ->press('POST')
                ->seePageIs('videos/1')
                ->see('This is another comment');
        // $this->countElements('.comment_comment', 2);
        // $this->countElements('.like-model', 3);
        // $this->countElements('.like-comment', 2);
    }

    public function testCommentCreateFailsNoComment()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);
        $page = $this->actingAs($user)
                ->visit('videos/1')
                ->type('', 'comment')
                ->press('POST')
                ->seePageIs('videos/1')
                ->see('The comment field is required.');
        // $this->countElements('.comment_comment', 1);
        // $this->countElements('.like-model', 2);
        // $this->countElements('.like-comment', 1);
    }

    public function testCommentCreateFailsCommentTooLong()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);
        $page = $this->actingAs($user)
                ->visit('videos/1')
                ->type('sdlkfjbnslkdfjbnlks dnflkbjnlsdnfkblksndlkvbn lsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsksdlkfjbnslkdfjbnlksdnflkbjnlsdnfkblksndlkvbnlsk', 'comment')
                ->press('POST')
                ->seePageIs('videos/1')
                ->see('The comment may not be greater than 255 characters');
    }

    public function testUserComments()
    {
        $this->createTTModels();
        $anotherComment = factory(Bolt\Comment::class)->create([
            'user_id'       => 1,
        ]);

        $user = Bolt\User::find(1);
        $comments = $user->comments()->get();
        $this->assertEquals(2, count($comments));
    }

    public function testCommentEdit()
    {
        $this->createTTModels();
        $user = Bolt\User::find(1);

        $this->actingAs($user)->call('PATCH', 'comments/1', ['_token' => csrf_token(), 'comment' => 'This is the updated comment.']);

        $comment = Bolt\Comment::find(1)->comment;
        // $text = $comment->comment;
        $this->assertEquals('This is the updated comment.', $comment);
    }

    public function testCommentUpdateFails() // When user is not looged in.
    {
        $this->createTTModels();

        $this->call('PATCH', 'comments/1', ['_token' => csrf_token(), 'comment' => 'This is the updated comment.']);

        $comment = Bolt\Comment::find(1);
        $text = $comment->comment;
        // $this->assertEquals('This is the updated comment.', $text);
    }

    public function testCommentDestroy()
    {
        $this->createTTModels();
        $user = Bolt\User::find(1);

        $this->actingAs($user)->call('DELETE', 'comments/1', ['_token' => csrf_token()]);
        $comment = Bolt\Comment::find(1);
        $this->assertEquals(null, $comment);
    }

    // Very descriptive
    public function testCommentUserCommentedAt()
    {
        $this->createTTModels();
        $comment = Bolt\Comment::find(1);
        $user = Bolt\User::find(1);
        $commenter = $comment->user;
        $commentedAt = $comment->commentedAt();
        $this->assertTrue($user == $commenter);
        $this->assertEquals('1 second ago', $commentedAt);
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

        $user = Bolt\User::find(1);

        $ajaxReturn = $this->actingAs($user)->json('PATCH', 'comments/1', ['comment' => 'This is the updated comment.'], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $response = get_object_vars($ajaxReturn)['response'];
        $jsonResponse = $response->content();

        $result = '{"status":"success","time":"1 second ago","edited":null}';

        $this->assertEquals($result, $jsonResponse);

        $this->assertEquals(200, $response->status());

        $video = Bolt\Video::find(1);

        $this->assertEquals(1, $video->comments()->count());

        $comments = $video->comments->toArray(); // One line of code.
        $comment = $comments[0]['comment'];

        $this->assertEquals('This is the updated comment.', $comment);
    }

    public function testCommentDeleteWithAjax()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);

        $ajaxReturn = $this->actingAs($user)->json('DELETE', 'comments/1', ['comment' => 'This is the updated comment.'], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $response = get_object_vars($ajaxReturn)['response'];
        $jsonResponse = $response->content();

        $result = '{"status":"success"}';

        $this->assertEquals($result, $jsonResponse);

        $this->assertEquals(200, $response->status());

        $video = Bolt\Video::find(1);

        $this->assertEquals(0, $video->comments()->count());
    }
}
