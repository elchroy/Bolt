<?php

namespace Bolt\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Bolt\Video;
use Bolt\Category;
use Bolt\Http\Requests;

class VideosController extends Controller
{

	public function __construct(Request $request)
	{
		$this->middleware('auth', ['only' => [
            'add',
            'createVideo',
            'edit',
            'updateVideo',
            'deleteVideo',
        ]]);

        $this->middleware('owner:' . $request->id . ',' . Video::class, ['only' => [
            'edit',
            'deleteVideo',
        ]]);

        $this->middleware('video', ['only' => [
            'createVideo',
            'updateVideo',
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
        $video = Video::find($request->id);
        $comments = $video->comments;

        return view('videos.show', compact('video', 'comments'));
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

    public function edit(Request $request)
    {
        $video = Video::find($request->id);

        return view('videos.edit', compact('video'));
    }

    public function updateVideo(Request $request)
    {
        $video = Video::find($request->id);

        $video->update($request->all());

        return redirect()->back();
    }

    public function deleteVideo(Request $request)
    {
        $video = Video::find($request->id);

        $video->delete();

        $request->session()->flash('success', 'Video Deleted');
        return redirect()->to('dashboard');
    }

    public function search(Request $request)
    {
        $data = $request->all();

        $toSearch = $data['search'];
        $videos = Video::where('title', 'LIKE', "%$toSearch%")->latest()->paginate(5);
        return view('videos.index', compact('videos'));
    }
}
