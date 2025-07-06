<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class NavigationItem extends Model
{
    protected $fillable = [
        'title',
        'url',
        'parent_id',
        'position',
        'is_active',
        'target'
    ];

    /**
     * Get the parent navigation item
     */
    public function parent()
    {
        return $this->belongsTo(NavigationItem::class, 'parent_id');
    }

    /**
     * Get the child navigation items
     */
    public function children()
    {
        return $this->hasMany(NavigationItem::class, 'parent_id')
                    ->orderBy('position', 'asc');
    }

    /**
     * Scope a query to only include active items.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include root level items.
     */
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }
}