<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundleType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'slug',
        'active',
        'features'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'float',
        'active' => 'boolean',
        'features' => 'array'
    ];

    /**
     * Get the features as an array
     *
     * @param mixed $value
     * @return array
     */
    public function getFeaturesAttribute($value)
    {
        // If it's already an array, return it
        if (is_array($value)) {
            return $value;
        }

        // If it's a JSON string, decode it
        if (is_string($value) && json_decode($value)) {
            return json_decode($value, true);
        }

        // If it's null or empty, return empty array
        return [];
    }
    
    /**
     * Get the bundles associated with this bundle type
     */
    public function bundles()
    {
        return $this->hasMany(Bundle::class);
    }
    
    /**
     * Get the bundle extras associated with this bundle type
     */
    public function extras()
    {
        return $this->hasMany(BundleExtra::class, 'bundle_id');
    }
}