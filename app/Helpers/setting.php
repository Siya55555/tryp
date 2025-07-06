<?php

use App\Models\Admin\Setting;

if (!function_exists('setting')) {
    /**
     * Get setting value
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting($key, $default = null)
    {
        return Setting::get($key, $default);
    }
}