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
		// $this->middleware('auth', ['only' => [
  //           'createComment',
  //           'updateComment',
  //           'deleteComment',
  //       ]]);

        // $this->middleware('owner:' . $request->id . ',' . Comment::class, ['only' => [
        //     'updateComment',
        //     'deleteComment',
        // ]]);

        // $this->middleware('validateComment', ['only' => [
        //     'createComment',
        //     'updateComment',
        // ]]);
	}
    public function createComment(Request $request)
    {
    	$data = $request->all();
    	$data['video_id'] = $request->id;

        $user = Auth::user();
        $user->comments()->create($data);

        return redirect()->back();
    }
    public function updateComment(Request $request)
    {
    	$comment = Comment::find($request->id);
    	$comment->update($request->all());
    	
    	return redirect()->back();
    }

    public function deleteComment(Request $request)
    {
    	$id = $request->id;
        Comment::destroy($id);
        
        return redirect()->back();
    }

    
}
