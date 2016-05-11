<?php

namespace Bolt\Http\Controllers;

use Bolt\Http\Requests;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $videos = $user->videos()->paginate(30);
        return view('dashboard', compact('videos', 'user'));
    }
}
