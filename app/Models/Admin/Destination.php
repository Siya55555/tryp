<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'bundle_id',
        'name',
        'location',
        'description',
        'main_image',
        'included_items',
        'restrictions',
        'gallery',
        'destination_type',
        'display_in_custom_bundles'
    ];

    protected $casts = [
        'included_items' => 'array',
        'gallery' => 'array',
        'display_in_custom_bundles' => 'boolean'
    ];

    public function bundle()
    {
        return $this->belongsTo(Bundle::class);
    }

    public function scopeDomestic($query)
    {
        return $query->where('destination_type', 'domestic');
    }

    public function scopeInternational($query)
    {
        return $query->where('destination_type', 'international');
    }

    public function scopeForCustomBundles($query)
    {
        return $query->where('display_in_custom_bundles', true);
    }
}