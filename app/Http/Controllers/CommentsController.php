<?php

namespace Bolt\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Bolt\Video;
use Bolt\Comment;
use Bolt\Http\Requests;

class CommentsController extends Controller
{

	public function __construct(Request $request)
	{
		$this->middleware('auth', ['only' => [
            'createComment',
            'updateComment',
            'deleteComment',
        ]]);

        // Next confirm that the requested comment of given ID is available.
        $this->middleware('available:' . Comment::class, ['only' => [
            'updateComment',
            'deleteComment',
        ]]);

        $this->middleware('owner:' . $request->id . ',' . Comment::class, ['only' => [
            'updateComment',
            'deleteComment',
        ]]);

        $this->middleware('comment', ['only' => [
            'createComment',
            'updateComment',
        ]]);
	}
    public function createComment(Request $request)
    {
    	$data = $request->all();
    	$data['video_id'] = $request->id;

        $user = Auth::user();
        $comment = $user->comments()->create($data);

        if ($request->ajax()) {
            $output = [
                'id'     => $comment->id,
                'status' => 'success',
            ];

            return json_encode($output);
        }

        return redirect()->back();
    }
    public function updateComment(Request $request)
    {
    	$comment = Comment::find($request->id);
    	$comment->update($request->all());
    	
    	if ($request->ajax()) {
            $output = [
                'status' => 'success',
            ];

            return json_encode($output);
        }

        return redirect()->back();
    }

    public function deleteComment(Request $request)
    {
    	$id = $request->id;
        Comment::destroy($id);
        
        if ($request->ajax()) {
            $output = [
                'status' => 'success',
            ];

            return json_encode($output);
        }

        return redirect()->back();
    }

    
}
