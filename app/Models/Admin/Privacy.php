<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privacy extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'status',
        'is_default',
        'meta_title',
        'meta_description'
    ];

    /**
     * Scope a query to only include active privacy policies.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get the latest active privacy policy.
     *
     * @return Privacy|null
     */
    public static function getLatest()
    {
        return self::active()->latest()->first();
    }
}