<?php

namespace App\Http\Controllers;

use App\Http\Services\CategoryService;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name|max:15',
            'slug'=> 'required|unique:categories,name|max:15'
        ],[
            'name.required' => 'Полето е задължително.',
            'name.unique' => 'Има запис с това име.',
            'name.max' => 'Записа не може да е повече от 15 символа.',
            'slug.required' => 'Полето е задължително.',
            'slug.unique' => 'Има запис с това име.',
            'slug.max' => 'Записа не може да е повече от 15 символа.'
        ]);

        Category::create([
            'name' => $request->string('name'),
            'slug' => $request->string('slug')
        ]);

        return redirect('/dashboard');
    }
}
