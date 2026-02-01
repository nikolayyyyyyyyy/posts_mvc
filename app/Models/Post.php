<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'user_author_id',
        'status',
        'count_likes'
    ];

    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_author_id');
    }
    
    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
