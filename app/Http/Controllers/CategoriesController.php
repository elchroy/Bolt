<?php

namespace Bolt\Http\Controllers;

use Auth;
use Bolt\Category;
use Bolt\User;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth', ['only' => [
            'add',
            'create',
            'edit',
            'update',
        ]]);

        // Next confirm that the requested category of given ID is available.
        $this->middleware('available:'.Category::class, ['only' => [
            'show',
            'edit',
            'update',
        ]]);

        $this->middleware('category', ['only' => [
            'create',
            'update',
        ]]);

        $this->middleware('owner:'.$request->id.','.Category::class, ['only' => [
            'edit',
        ]]);
    }

    public function index()
    {
        $categories = Category::orderBy('name')->get();
        $title = 'All Categories';

        return view('categories.index', compact('categories', 'title'));
    }

    public function add(Request $request)
    {
        $title = 'Add Category';

        return view('categories.add', compact('title'));
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
        $videos = $category->videos()->paginate(60);
        $paging = $videos->render();

        return view('videos.index', compact('category', 'videos', 'paging', 'title'));
    }

    public function edit(Request $request)
    {
        $category = Category::find($request->id);
        $title = "Edit Category - $category->name";

        return view('categories.edit', compact('category', 'title'));
    }

    public function update(Request $request)
    {
        $category = Category::find($request->id);
        $category->update($request->all());

        $request->session()->flash('success', 'Updated');

        return redirect()->to('dashboard');
    }
}
