<?php

namespace Bolt\Http\Controllers;

use Illuminate\Http\Request;

use Bolt\Http\Requests;
use Bolt\Category;
use Bolt\User;
use Auth;

class CategoriesController extends Controller
{
    public function __construct(Request $request)
    {
    	$this->middleware('auth', ['only' => [
            'add',
            'create',
            'edit',
            'update'
        ]]);

        // Next confirm that the requested category of given ID is available.
        $this->middleware('available:' . Category::class, ['only' => [
            'show',
            'edit',
            'update',
        ]]);

        $this->middleware('category', ['only' => [
            'create',
            // 'update'
        ]]);

        $this->middleware('owner:' . $request->id . ',' . Category::class, ['only' => [
            'edit',
        ]]);
    }

    public function index()
    {
        $categories = Category::orderBy('name')->paginate(30);
        $paging = $categories->render();

        return view('categories.index', compact('categories', 'paging'));
    }

    public function add(Request $request)
    {
    	return view('categories.add');
    }

    public function create(Request $request)
    {
    	$user = Auth::user();
    	$user->categories()->create($request->all());

    	$request->session()->flash('success', 'Created');
    	return redirect()->to('dashboard');
    }

    public function show(Request $request)
    {
    	$category = Category::find($request->id);
    	$title = $category->name;
    	$videos = $category->videos()->paginate(24);
    	$paging = $videos->render();

    	return view('videos.index', compact('category', 'videos', 'paging', 'title'));
    }

    public function edit(Request $request)
    {
    	$category = Category::find($request->id);

    	return view('categories.edit', compact('category'));
    }

    public function update(Request $request)
    {
    	$category = Category::find($request->id);
    	$category->update($request->all());

    	$request->session()->flash('success', 'Updated');
    	return redirect()->to('dashboard');
    }
}
