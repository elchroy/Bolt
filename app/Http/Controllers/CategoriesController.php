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
        ]]);

        $this->middleware('category', ['only' => [
            'create',
        ]]);
    }


    public function add(Request $request)
    {
    	return view('categories/add');
    }

    public function create(Request $request)
    {
    	$user = Auth::user();
    	$user->categories()->create($request->all());

    	return view('dashboard');
    }
}
