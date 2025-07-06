<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'short_description', 'description',
        'price', 'original_price', 'rating', 'reviews_count',
        'card_image', 'hero_image', 'gallery_main_image', 
        'gallery', 'features'
    ];

    protected $casts = [
        'gallery' => 'array',
        'features' => 'array',
    ];

    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }

    public function extras()
    {
        return $this->hasMany(BundleExtra::class);
    }

    public function bookings()
    {
        return $this->hasMany(UserBooking::class);
    }
    
}
