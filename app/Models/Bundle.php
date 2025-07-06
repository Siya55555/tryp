<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'price',
        'original_price',
        'rating',
        'reviews_count',
        'card_image',
        'hero_image',
        'gallery_main_image',
        'gallery',
        'features'
    ];

    protected $casts = [
        'gallery' => 'array',
        'features' => 'array',
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'rating' => 'decimal:2'
    ];

    /**
     * Get the destinations for the bundle.
     */
    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }

    /**
     * Get the extras for the bundle.
     */
    public function extras()
    {
        return $this->hasMany(BundleExtra::class);
    }
}