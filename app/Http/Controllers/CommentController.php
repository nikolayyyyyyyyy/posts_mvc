<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|max:1000',
            'author_user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id'
        ],[
            'body.required' => 'Полето е задължително.',
            'body.max' => 'Полето не може да е над 1000 символа.',
            'author_user_id.required' => 'Полето е задължително.',
            'post_id.required' => 'Полето е задължително.',
            'author_user_id.exists' => 'Няма запис с това ID.',
            'post_id.exists' => 'Няма запис с това ID.'
        ]);

        Comment::create([
            'body' => $request->string('body'),
            'author_user_id' => $request->integer('author_user_id'),
            'post_id' => $request->integer('post_id'),
            'status' => 'posted'
        ]);

        return redirect('/dashboard');
    }
}
