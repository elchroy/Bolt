<?php

namespace Bolt\Http\Repositories;

use Bolt\Comment;
use Bolt\Http\Controllers\Controller;
use Bolt\Video;
use Illuminate\Http\Request;

class CommentRepository extends Controller
{
    protected $video;

    public function __construct(Request $request)
    {
        $this->video = Video::find($request->id);
    }

    public function getCommentsOfVideo()
    {
        return $this->video->comments();
    }

    public function getLatestComments($number = 10)
    {
        return $this->getCommentsOfVideo()->latest()->paginate($number);
    }

    public function findComment($id)
    {
        return Comment::find($id);
    }
}
