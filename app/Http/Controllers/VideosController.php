<?php

namespace Bolt\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Bolt\Video;
use Bolt\Category;
use Bolt\Http\Requests;

class VideosController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth', ['only' => [
            'add',
            'createVideo',
        ]]);
	}
    
    public function index()
    {
        $videos = Video::latest()->paginate(24);
        $categories = Category::all();
        $paging = $videos->render();
        return view('videos.index', compact('videos', 'categories', 'paging'));
    }

    public function show(Request $request)
    {
    	$id = $request->id;
        $video = Video::find($id);
        return view('videos.show', compact('video'));
    }

    public function add()
    {
    	$this->middleware('auth');

    	return view('videos.add');
    }


    public function createVideo(Request $request)
    {
        $user = Auth::user();

        $data = $request->all();
        
        $user->videos()->create($data);
        return redirect('dashboard');
    }
}
