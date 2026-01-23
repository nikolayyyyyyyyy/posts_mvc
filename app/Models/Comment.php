<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamp = false;

    protected $fillable = [
        'post_id',
        'author_user_id',
        'body',
        'status'
    ];
}
