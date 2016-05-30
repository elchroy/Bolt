<?php

namespace Bolt\Http\Controllers;

use Auth;
use Bolt\Http\Controllers\States\VideoState;

class PagesController extends Controller
{
    protected $state;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VideoState $state)
    {
        $this->middleware('auth', ['only' => 'dashboard']);

        $this->state = $state;
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
        $recent = $this->state->recent(8);
        $mostLikedVideos = $this->state->top(4);
        $top = $this->state->mostLiked();

        $title = 'Home';

        return view('welcome', compact('recent', 'mostLikedVideos', 'title', 'top'));
    }
}
