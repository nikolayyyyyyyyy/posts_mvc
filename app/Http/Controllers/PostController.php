<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

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
            'tags' => 'required|array',
            'count' => 'nullable|numeric'
        ],[
            'title.required' => 'Полето е задължително.',
            'slug.required' => 'Полето е задължително.',
            'slug.unique' => 'Има запис с този слъг.',
            'content.max' => 'Полето трябва да е до 500 символа.',
            'categories.required' => 'Минимум 1.',
            'tags.required' => 'Минимум 1.',
            'count.numeric' => 'Полето трябва да е с числова стойност.'
        ]);
        
        $path = null;
        if($request->hasFile('post_image'))
        {
           $path = Storage::disk('public')->put('posts_photos', $request->post_image);
        }

        $post = Post::create([
            'title' => $request->string('title'),
            'content' => $request->string('content'),
            'slug' => $request->string('slug'),
            'user_author_id' => Auth::user()->id,
            'status' => 'posted',
            'count_likes' => $request->integer('count') != null ? $request->integer('count') : 0
        ]);
        
        $post->categories()->attach($request->array('categories'));
        $post->tags()->attach($request->array('tags'));
        
        if($path != null)
        {
            Media::create([
                'post_id' => $post->id,
                'file_path' => $path,
                'kind' => 'photo'
            ]);
        }

        return redirect('/dashboard');
    }

    public function getPostsByCategorySlug(Request $request)
    {   
        $request->validate(['slug' => 'required|exists:categories,slug|max:20'], 
        [
            'slug.required' => 'Полето е задължително.',
            'slug.exists'   => 'Няма запис с това име.',
            'slug.max'      => 'Полето не може да е над 20 символа.',
        ]);

        $slug = $request->string('slug');

        return Inertia::render('User/Lists/PostByCategory',
            ['posts' => Post::whereHas('categories', function ($q) use ($slug) {
                $q->where('slug', $slug);
        })->with(['categories','tags'])->get()]);
    }

    public function getPostsByTagSlug(Request $request)
    {
        $request->validate([
            'slug' => 'required|exists:tags,slug|max:30'
        ],[
            'slug.required' => 'Полето е задължително',
            'slug.exists' => 'Няма запис с това Id.',
            'slug.max' => 'Полето трябва да е до 30 символа.'
        ]);

        $slug = $request->string('slug');

        return Inertia::render('User/Lists/PostByTagSlug',
            ['posts' => Post::whereHas('tags', function($q) use ($slug) {
                $q->where('slug', '=', $slug);
            })->with('categories', 'tags')->get()]);
    }

    public function getUserPosts(Request $request)
    {
        $request->validate([ 'id' => 'required|numeric|exists:users,id' ],
        [
            'id.required' => 'Полето е задължително.',
            'id.numeric' => 'Полето трябва да е с числова стойност.',
            'id.exists' => 'Няма запис с това Id.'
        ]);

        $users = User::orderBy('id', 'desc')->get();
        $user = User::find($request->integer('id'));
        $posts = Post::whereBelongsTo($user)->get();

        return Inertia::render('User/Lists/PostByAuthor',
        [
            'posts' => $posts,
            'users' => $users
        ]);
    }

    public function getLastestCommentsForPost(Request $request)
    {
        $request->validate([ 'id' => 'required|numeric|exists:posts,id' ],
        [
            'id.required' => 'Полето е задължително.',
            'id.numeric' => 'Полето трябва да е с числова стойност.',
            'id.exists' => 'Няма запис с това Id.'
        ]);

        $post = Post::find($request->integer('id'));
        $comments = $post->comments()
            ->with('user')
            ->latest()
            ->get()
            ->map(fn ($comment) => [
                'body' => $comment->body,
                'user_email' => $comment->user->email,
                'created_at' => $comment->created_at
            ]);

        $posts = Post::all()->select(['id', 'slug', 'title']);
        return Inertia::render('LastCommentsForPage', [
            'comments' => $comments,
            'posts' => $posts
        ]);
    }
}
