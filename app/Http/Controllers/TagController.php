<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags,name|max:15',
            'slug'=> 'required|unique:tags,slug|max:15'
        ],[
            'name.required' => 'Полето е задължително.',
            'name.unique' => 'Има запис с това име.',
            'name.max' => 'Записа не може да е повече от 15 символа.',
            'slug.required' => 'Полето е задължително.',
            'slug.unique' => 'Има запис с това име.',
            'slug.max' => 'Записа не може да е повече от 15 символа.'
        ]);

        Tag::create([
            'name' => $request->string('name'),
            'slug' => $request->string('slug')
        ]);

        return redirect('/dashboard');
    }
}
