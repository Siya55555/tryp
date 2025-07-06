<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Blog extends Model
{
    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'featured_image', 
        'status', 'category_id', 'author', 'author_image', 
        'author_bio', 'read_time', 'views', 'published_at'
    ];

    protected $dates = ['published_at'];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tag', 'blog_id', 'tag_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Optional: Accessor for published_at to ensure Carbon instance
    public function getPublishedAtAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }
}