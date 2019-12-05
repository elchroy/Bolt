<?php

namespace Bolt\Http\Controllers;

use Auth;
use Bolt\Category;
use Bolt\Http\Repositories\CategoryRepository as CatRepo;
use Bolt\User;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * The authenticated user instance.
     *
     * @var [type]
     */
    protected $user;

    /**
     * The category repository instance.
     *
     * @var [type]
     */
    protected $catRepo;

    /**
     * The category instance.
     */
    protected $category;

    public function __construct(Request $request, CatRepo $catRepo)
    {
        $this->middleware('auth', ['except' => [
            'index',
            'show',
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
            'update',
        ]]);

        $this->user = Auth::user();

        $this->catRepo = $catRepo;

        $this->category = $this->catRepo->findCategory($request->id);
    }

    public function index()
    {
        $data = [
            'categories' => $this->catRepo->getCatByOrder(),
            'title'      => 'All Categories',
        ];

        return view('categories.index', $data);
    }

    public function add()
    {
        return view('categories.add', ['title' => 'Add Category']);
    }

    public function create(Request $request)
    {
        $this->user->categories()->create($request->all());

        $request->session()->flash('success', 'Created');

        return redirect()->to('dashboard');
    }

    public function show()
    {
        $videos = $this->category->videos()->paginate(60);
        $paging = $videos->render();

        $data = [
            'category' => $this->category,
            'videos'   => $videos,
            'paging'   => $paging,
            'title'    => $this->category->name,
        ];

        return view('videos.index', $data);
    }

    public function edit()
    {
        $data = [
            'category' => $this->category,
            'title'    => "Edit Category - $this->category->name",
        ];

        return view('categories.edit', $data);
    }

    public function update(Request $request)
    {
        $this->category->update($request->all());

        $request->session()->flash('success', 'Updated');

        return redirect()->to('dashboard');
    }
}
