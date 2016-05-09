<?php

namespace Bolt\Http\Controllers;

use Illuminate\Http\Request;

use Bolt\Video;
use Bolt\Category;
use Bolt\Http\Requests;

class VideosController extends Controller
{
    
    public function index()
    {
        $videos = Video::latest()->paginate(24);
        $categories = Category::all();
        $paging = $videos->render();
        return view('videos.index', compact('videos', 'categories', 'paging'));
    }
}
