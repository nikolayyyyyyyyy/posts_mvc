<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $timestaps = false;

    public $fillable = [
        'name',
        'slug'
    ];
}
