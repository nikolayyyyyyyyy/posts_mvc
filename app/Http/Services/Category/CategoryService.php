<?php
namespace App\Http\Services\Category;

use App\Http\Services\Category\CategoryServiceInterface;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryService implements CategoryServiceInterface
{
    public function createCategory(Request $request)
    {
        Category::create([
            'name' => $request->string('name'),
            'slug' => $request->string('slug')
        ]);
    }
}