<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Media;
use App\Models\Category;
use App\Models\PostCategory;

class PostService
{
    public function createPost(Request $request)
    {
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
        
        if($path)
        {
            Media::create([
                'post_id' => $post->id,
                'file_path' => $path,
                'kind' => 'photo'
            ]);
        }
    }
}