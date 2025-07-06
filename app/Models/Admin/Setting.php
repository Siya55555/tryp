<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'group'];

    /**
     * Get setting value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        // Try to get from cache first
        $cacheKey = "setting.{$key}";
        
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }
        
        // Get from database if not in cache
        $setting = self::where('key', $key)->first();
        
        if ($setting) {
            // Store in cache for future use (24 hours)
            Cache::put($cacheKey, $setting->value, 60 * 24);
            return $setting->value;
        }
        
        return $default;
    }

    /**
     * Set setting value
     *
     * @param string $key
     * @param mixed $value
     * @param string $group
     * @return bool
     */
    public static function set($key, $value, $group = 'general')
    {
        $setting = self::firstOrNew(['key' => $key]);
        $setting->value = $value;
        $setting->group = $group;
        
        // Update the cache if setting is saved
        if ($setting->save()) {
            Cache::put("setting.{$key}", $value, 60 * 24);
            return true;
        }
        
        return false;
    }

    /**
     * Get all settings by group
     *
     * @param string $group
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getByGroup($group)
    {
        return self::where('group', $group)->get();
    }

    /**
     * Clear the settings cache
     *
     * @return void
     */
    public static function clearCache()
    {
        // Find all settings and clear individual caches
        $settings = self::all();
        
        foreach ($settings as $setting) {
            Cache::forget("setting.{$setting->key}");
        }
    }
}