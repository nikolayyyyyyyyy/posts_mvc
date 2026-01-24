<?php

namespace App\Http\Controllers;

use App\Http\Services\PostService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    private PostService $post_service;

    public function __construct(PostService $post_service)
    {
        $this->post_service = $post_service;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'nullable|max:500',
            'slug' => 'required|unique:posts,slug',
            'post_image' => 'nullable',
            'categories' => 'required|array'
        ],[
            'title.required' => 'Полето е задължително.',
            'slug.required' => 'Полето е задължително.',
            'slug.unique' => 'Има запис с този слъг.',
            'content.max' => 'Полето трябва да е до 500 символа.'
        ]);

        $this->post_service->createPost($request);
        return redirect('/dashboard');
    }
}
