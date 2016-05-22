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
        // First confirm if the user is authenticated
		$this->middleware('auth', ['only' => [
            'add',
            'createVideo',
            'edit',
            'updateVideo',
            'deleteVideo',
            'favorite',
            'unfavorite',
        ]]);

        // Next confirm that the requested video of given ID is available.
        $this->middleware('available:' . Video::class, ['only' => [
            'edit',
            'show',
            'updateVideo',
            'deleteVideo',
        ]]);

        // Next confirm that the user is the correct owner of the requested video.
        $this->middleware('owner:' . $request->id . ',' . Video::class, ['only' => [
            'edit',
            'deleteVideo',
        ]]);

        // Validate the request data.
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
        $title = 'All Videos';
        return view('videos.index', compact('videos', 'categories', 'paging', 'title'));
    }

    public function show(Request $request)
    {
        $video = Video::find($request->id);
        $comments = $video->comments()->latest()->paginate(15);

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

        // First delete all Video's decendanta (comments and favorites)
        $this->deleteChildrenOf($video);

        // The delete the video.
        $video->delete();

        $request->session()->flash('success', 'Video Deleted');
        return redirect()->to('dashboard');
    }

    public function search(Request $request)
    {
        $data = $request->all();

        $toSearch = $data['search'];
        $videos = Video::where('title', 'LIKE', "%$toSearch%")->latest()->paginate(12);
        $title = "Search results for '$toSearch'";
        $paging = $videos->appends(['search' => $toSearch])->links();

        return view('videos.index', compact('videos', 'paging', 'title'));
    }

    public function favorite(Request $request)
    {
        $video = Video::find($request->id);

        $liked = $video->favorites()->liked()->first();
        
        if ($liked == null) {
            $liked = $video->favorites()->create([
                        'user_id' => Auth::user()->id,
                    ]);
        }

        $liked->activate();

        if($request->ajax()){
            
            $output = [
                'status' => 'success',
                'message' => 'Done',
            ];

            return json_encode($output);
        }

        return redirect()->back();
    }

    public function unfavorite(Request $request)
    {
        $video = Video::find($request->id);

        $liked = $video->favorites()->liked()->first();

        $liked->deactivate();

        if($request->ajax()){
            
            $output = [
                'status' => 'success',
                'message' => 'Done',
            ];

            return json_encode($output);
        }

        return redirect()->back();
    }

    private function deleteChildrenOf(Video $video)
    {
        foreach ($video->comments as $comment) {
            $comment->delete();
        }

        foreach ($video->favorites as $favorite) {
            $favorite->delete();
        }
    }
}
