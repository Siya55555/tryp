<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaptchaSetting extends Model
{
    use HasFactory;

    protected $table = 'captcha_settings';
    
    protected $fillable = [
        'site_key',
        'secret_key',
        'enabled',
        'enable_on_login',
        'enable_on_register',
        'enable_on_contact'
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'enable_on_login' => 'boolean',
        'enable_on_register' => 'boolean',
        'enable_on_contact' => 'boolean',
    ];

    /**
     * Get the site key or use the one from config if not set in database
     */
    public function getSiteKeyAttribute($value)
    {
        return $value ?: config('turnstile.turnstile_site_key');
    }

    /**
     * Get the secret key or use the one from config if not set in database
     */
    public function getSecretKeyAttribute($value)
    {
        return $value ?: config('turnstile.turnstile_secret_key');
    }    /**
     * Check if captcha is enabled for a specific form
     */
    public static function isEnabledFor($form)
    {
        $settings = self::first();
        
        if (!$settings) {
            return false;
        }
        
        // Handle both array and object cases
        if (is_array($settings)) {
            return isset($settings['enabled']) && $settings['enabled'] && 
                   isset($settings["enable_on_$form"]) && $settings["enable_on_$form"];
        }
        
        return $settings->enabled && ($settings->{"enable_on_$form"} ?? false);
    }
}
