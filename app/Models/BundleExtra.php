<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BundleExtra extends Model
{
    protected $fillable = [
        'bundle_id',
        'title',
        'description',
        'image'
    ];

    /**
     * Get the bundle that owns the extra.
     */
    public function bundle()
    {
        return $this->belongsTo(Bundle::class);
    }
}