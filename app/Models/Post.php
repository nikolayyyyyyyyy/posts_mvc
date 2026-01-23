<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $timestaps = false;

    public $fillable = [
        'title',
        'slug',
        'content',
        'author_user_id',
        'status'
    ];
}
