<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'user_author_id',
        'status'
    ];
}
