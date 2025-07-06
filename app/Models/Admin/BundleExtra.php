<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class BundleExtra extends Model
{
    protected $fillable = [
        'bundle_id', 
        'title', 
        'description', 
        'image'
    ];

    public function bundle()
    {
        return $this->belongsTo(Bundle::class);
    }
    public function extras()
    {
        return $this->hasMany(BundleExtra::class);
    }
}