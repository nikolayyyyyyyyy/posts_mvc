<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $timestamp = false;

    public $fillable = [
        'post_id',
        'author_user_id',
        'body',
        'status'
    ];
}
