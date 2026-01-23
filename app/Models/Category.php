<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestaps = false;

    protected $fillable = [
        'name',
        'slug'
    ];
}
