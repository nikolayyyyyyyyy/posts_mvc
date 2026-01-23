<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    public $timestamp = false;

    protected $fillable = [
        'post_id',
        'tag_id'
    ];
}
