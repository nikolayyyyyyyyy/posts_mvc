<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'nullable|max:500',
            'slug' => 'required|unique:posts,slug',
            'post_image' => 'nullable|image',
            'categories' => 'required|array',
            'tags' => 'required|array'
        ],[
            'title.required' => 'Полето е задължително.',
            'slug.required' => 'Полето е задължително.',
            'slug.unique' => 'Има запис с този слъг.',
            'content.max' => 'Полето трябва да е до 500 символа.',
            'categories.required' => 'Минимум 1.',
            'tags.required' => 'Минимум 1.'
        ]);

        if($request->hasFile('post_image'))
        {
           $path = Storage::disk('public')->put('posts_photos', $request->post_image);
        }

        $post = Post::create([
            'title' => $request->string('title'),
            'content' => $request->string('content'),
            'slug' => $request->string('slug'),
            'user_author_id' => Auth::user()->id,
            'status' => 'posted'
        ]);
        
        $post->categories()->attach($request->array('categories'));
        $post->tags()->attach($request->array('tags'));
        
        if($path)
        {
            Media::create([
                'post_id' => $post->id,
                'file_path' => $path,
                'kind' => 'photo'
            ]);
        }

        return redirect('/dashboard');
    }
}
