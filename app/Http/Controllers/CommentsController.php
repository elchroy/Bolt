<?php

namespace Bolt\Http\Controllers;

use Auth;
use Bolt\Comment;
use Illuminate\Http\Request;
use Bolt\Http\Repositories\CommentRepository as ComRepo;

class CommentsController extends Controller
{
    /**
     * The authenticated user instance.
     * @var [type]
     */
    protected $user;

    protected $comRepo;

    public function __construct(Request $request, ComRepo $comRepo)
    {
        $this->middleware('auth', ['except' => [
        ]]);

        // Confirm that the requested comment of given ID is available.
        $this->middleware('available:'.Comment::class, ['except' => [
            'createComment',
        ]]);

        // Confirm that the current user is the owner of the comment.
        $this->middleware('owner:'.$request->id.','.Comment::class, ['except' => [
            'createComment',
        ]]);

        $this->middleware('comment', ['except' => [
            'deleteComment',
        ]]);

        $this->user = Auth::user();
        $this->comRepo = $comRepo;
    }

    public function createComment(Request $request)
    {
        $data = $request->all();
        $data['video_id'] = $request->id;

        $id = $this->user->comments()->create($data)->id;

        if ($request->ajax()) {
            $output = [
                'id'         => $id,
                'deltoken'   => csrf_token(),
                'edittoken'  => csrf_token(),
                'status'     => 'success',
            ];

            return json_encode($output);
        }

        return redirect()->back();
    }

    public function updateComment(Request $request)
    {
        $comment = $this->comRepo->findComment($request->id);
        $comment->update($request->all());

        if ($request->ajax()) {
            $output = [
                'status' => 'success',
                'time'   => $comment->created_at->diffForHumans(),
                'edited' => $comment->is_edited(),

            ];

            return json_encode($output);
        }

        return redirect()->back();
    }

    public function deleteComment(Request $request)
    {
        $this->comRepo->findComment($request->id)->delete();

        if ($request->ajax()) {
            $output = [
                'status' => 'success',
            ];

            return json_encode($output);
        }

        return redirect()->back();
    }
}
