<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'content' => 'required|max:500',
            'slug' => 'required|unique:posts,slug'
        ]);

        if($validator->fails())
        {
            return redirect('/posts-create')->withErrors($validator->errors());
        }

        $post = Post::create([
            'title' => $request->string('title'),
            'content' => $request->string('content'),
            'slug' => $request->string('slug'),
            'user_author_id' => Auth::user()->id,
            'status' => 'posted'
        ]);

        return redirect('/');
    }
}
