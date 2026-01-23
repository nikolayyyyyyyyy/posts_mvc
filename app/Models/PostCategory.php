<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $timestaps = false;

    public $fillable = [
        'post_id',
        'category_id',
    ];
}
