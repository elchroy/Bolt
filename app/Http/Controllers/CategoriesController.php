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

        $this->middleware('category', ['only' => [
            'create',
            // 'update'
        ]]);

        $this->middleware('owner:' . $request->id . ',' . Category::class, ['only' => [
            'edit',
        ]]);
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
