<?php

namespace App\Services;

use App\Models\Admin\NavigationItem;
use Illuminate\Support\Facades\Cache;

class NavigationService
{
    /**
     * Get the main navigation structure
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMainNav()
    {
        return Cache::remember('main_navigation', 60 * 24, function () {
            return NavigationItem::with(['children' => function ($query) {
                $query->active()->orderBy('position', 'asc');
            }])
            ->root()
            ->active()
            ->orderBy('position', 'asc')
            ->get();
        });
    }
    
    /**
     * Clear the navigation cache
     *
     * @return void
     */
    public function clearCache()
    {
        Cache::forget('main_navigation');
    }
}