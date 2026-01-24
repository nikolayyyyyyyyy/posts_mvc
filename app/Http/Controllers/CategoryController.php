<?php

namespace App\Http\Controllers;

use App\Http\Services\Category\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryService $category_service;

    public function __construct(CategoryService $category_service)
    {
        $this->category_service = $category_service;
    }

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

        $this->category_service->createCategory($request);
        return redirect('/dashboard');
    }
}
