<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryShowController extends Controller
{
    public function __invoke($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $query = $category->adverts()->orderBy('created_at', 'desc');
        $adverts = $query->paginate(15);

        return view('categories.show', ['category' => $category, 'adverts' => $adverts]);

    }
}
