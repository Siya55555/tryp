<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Setting;

class ShareSettings
{
    public function handle(Request $request, Closure $next)
    {
        $settings = Setting::all()->keyBy('key');
        view()->share('settings', $settings);
        return $next($request);
    }
}