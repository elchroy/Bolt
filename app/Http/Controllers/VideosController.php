<?php

namespace Bolt\Http\Controllers;

use Auth;
use Bolt\Category;
use Bolt\Video;
use Illuminate\Http\Request;

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
        $this->middleware('available:'.Video::class, ['only' => [
            'edit',
            'show',
            'updateVideo',
            'deleteVideo',
        ]]);

        // Next confirm that the user is the correct owner of the requested video.
        $this->middleware('owner:'.$request->id.','.Video::class, ['only' => [
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
        $videos = Video::latest()->paginate(60);
        $categories = Category::all();
        $paging = $videos->render();
        $category = null;
        $title = 'All Videos';

        return view('videos.index', compact('videos', 'categories', 'paging', 'title', 'category'));
    }

    public function show(Request $request)
    {
        $video = Video::find($request->id);
        $comments = $video->comments()->latest()->paginate(15);
        $title = "$video->title";

        return view('videos.show', compact('video', 'comments', 'title'));
    }

    public function add()
    {
        $this->middleware('auth');

        $title = 'Add Video';

        return view('videos.add', compact('title'));
    }

    public function createVideo(Request $request)
    {
        $user = Auth::user();

        $data = $request->all();
        $data['url'] = $this->createURL($request->url);

        $user->videos()->create($data);

        return redirect('dashboard');
    }

    public function edit(Request $request)
    {
        $video = Video::find($request->id);

        $title = "Edit $video->title";

        return view('videos.edit', compact('video', 'title'));
    }

    public function updateVideo(Request $request)
    {
        $video = Video::find($request->id);

        $video->update($request->all());

        return redirect()->to('dashboard');
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
        $condition = env('APP_ENV') == 'production' ? 'ILIKE' : 'LIKE';
        $videos = Video::where('title', $condition, "%$toSearch%")->latest()->paginate(60);
        $title = "Search results for '$toSearch'";
        $paging = $videos->appends(['search' => $toSearch])->links();
        $category = null;

        return view('videos.search', compact('videos', 'paging', 'title', 'toSearch', 'category'));
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

        if ($request->ajax()) {
            $output = [
                'status'  => 'success',
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

        if ($request->ajax()) {
            $output = [
                'status'  => 'success',
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

    public function check(Request $request)
    {
        $url = 'http://www.youtube.com/oembed?url='.$request->url.'&format=json';
        $headers = get_headers($url);

        return substr($headers[0], 9, 3) !== '404' ? 'found' : 'not found';
    }

    private function createURL($url)
    {
        $videoCode = substr($url, -11);

        return "https://www.youtube.com/watch?v=$videoCode";
    }
}
