<?php

namespace Bolt\Http\Controllers;

use Auth;
use Bolt\Category;
use Bolt\Video;
use Illuminate\Http\Request;
use Bolt\Http\Repositories\CategoryRepository as CatRepo;
use Bolt\Http\Repositories\VideoRepository as VidRepo;
use Bolt\Http\Repositories\CommentRepository as ComRepo;

class VideosController extends Controller
{
    /**
     * The category repo instance
     * @var [type]
     */
    protected $catRepo;

    /**
     * The video repo instance.
     * @var [type]
     */
    protected $vidRepo;

    /**
     * The comment repo instance.
     * @var [type]
     */
    protected $comRepo;

    /**
     * The authenticated user instance.
     * @var [type]
     */
    protected $user;

    /**
     * A video instance.
     * @var [type]
     */
    protected $video;
    
    public function __construct(Request $request, CatRepo $catRepo, VidRepo $vidRepo, ComRepo $comRepo)
    {
        $this->middleware('auth', [ 'except' => [
            'index', 'show', 'search', 'check', 'createURL'
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

        $this->catRepo = $catRepo;

        $this->vidRepo = $vidRepo;

        $this->comRepo = $comRepo;

        $this->user = Auth::user();

        $this->video = $this->vidRepo->findVideo($request->id);
    }

    public function index()
    {
        $videos = $this->vidRepo->getLatest(60);
        $categories = $this->catRepo->getAllCategories();
        $paging = $videos->render();
        $category = null;
        $title = 'All Videos';

        return view('videos.index', compact('videos', 'categories', 'paging', 'title', 'category'));
    }

    public function show()
    {
        $data = [
            'video' => $this->video,
            'title' => $this->video->title,
            'comments' => $this->comRepo->getLatestComments(15),
        ];

        return view('videos.show', $data);
    }

    public function add()
    {
        $this->middleware('auth');

        $title = 'Add Video';

        return view('videos.add', compact('title'));
    }

    public function createVideo(Request $request)
    {

        $data = $request->all();
        $data['url'] = $this->createURL($request->url);

        $this->user->videos()->create($data);

        return redirect('dashboard');
    }

    public function edit(Request $request)
    {
        $data = [
            'video' => $this->video,
            'title' => $this->video->title,
        ];

        return view('videos.edit', $data);
    }

    public function updateVideo(Request $request)
    {
        $this->video->update($request->all());

        return redirect()->to('dashboard');
    }

    public function deleteVideo(Request $request)
    {
        $this->video->deleteChildren()->delete();

        $request->session()->flash('success', 'Video Deleted');

        return redirect()->to('dashboard');
    }

    public function search(Request $request)
    {
        $data = $request->all();

        $toSearch = $data['search'];
        $videos = $this->vidRepo->searchVids($toSearch, 60);
        $title = "Search results for '$toSearch'";
        $paging = $videos->appends(['search' => $toSearch])->links();
        $category = null;

        return view('videos.search', compact('videos', 'paging', 'title', 'toSearch', 'category'));
    }

    public function favorite(Request $request)
    {
        $liked = $this->video->favorites()->liked()->first();

        if ($liked == null) {
            $liked = $this->video->favorites()->create([
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
        $liked = $this->video->favorites()->liked()->first();

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
