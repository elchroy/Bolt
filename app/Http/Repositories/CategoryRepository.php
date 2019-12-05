<?php

namespace Bolt\Http\Repositories;

use Bolt\Category;
use Bolt\Http\Controllers\Controller;

class CategoryRepository extends Controller
{
    public function getAllCategories()
    {
        return Category::all();
    }

    public function getCatByOrder()
    {
        return Category::orderBy('name')->get();
    }

    public function findCategory($id)
    {
        return Category::find($id);
    }
}
