<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    protected $timestamp = false;

    public $fillable = [
        'post_id',
        'tag_id'
    ];
}
