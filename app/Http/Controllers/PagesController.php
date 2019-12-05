<?php

namespace Bolt\Http\Controllers;

use Auth;
use Bolt\Http\Repositories\VideoRepository;

class PagesController extends Controller
{
    protected $vidRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VideoRepository $vidRepo)
    {
        $this->middleware('auth', ['only' => 'dashboard']);

        $this->vidRepo = $vidRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $user = Auth::user();
        $videos = $user->videos()->paginate(60);
        $favs = $user->favoriteVideos();
        $categories = $user->categories()->paginate(10);
        $title = $user->name;

        return view('dashboard', compact('videos', 'user', 'favs', 'categories', 'title'));
    }

    public function welcome()
    {
        $recent = $this->vidRepo->recent(8);
        $mostLikedVideos = $this->vidRepo->top(4);
        $top = $this->vidRepo->mostLiked();

        $title = 'Home';

        return view('welcome', compact('recent', 'mostLikedVideos', 'title', 'top'));
    }
}
