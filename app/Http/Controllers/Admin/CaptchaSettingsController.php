<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\CaptchaSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class CaptchaSettingsController extends Controller
{
    /**
     * Show the form for editing captcha settings
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        // Make sure we get a model instance, not an array
        $settings = CaptchaSetting::first();
        
        // If no settings exist, create a new model instance
        if (!$settings) {
            $settings = new CaptchaSetting();
            $settings->enabled = false;
            $settings->enable_on_login = true;
            $settings->enable_on_register = true;
            $settings->enable_on_contact = true;
            $settings->site_key = config('turnstile.turnstile_site_key');
            $settings->secret_key = config('turnstile.turnstile_secret_key');
        }
        
        // Ensure we're dealing with an object
        if (is_array($settings)) {
            $model = new CaptchaSetting();
            foreach ($settings as $key => $value) {
                $model->{$key} = $value;
            }
            $settings = $model;
        }
        
        // For debugging
        \Log::info('CaptchaSettings type: ' . gettype($settings));
        \Log::info('CaptchaSettings: ' . json_encode($settings));
        
        return view('admin.settings.captcha', ['settings' => $settings]);
    }

    /**
     * Update the captcha settings
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_key' => 'required_if:enabled,1|nullable|string|max:255',
            'secret_key' => 'required_if:enabled,1|nullable|string|max:255',
            'enabled' => 'boolean',
            'enable_on_login' => 'boolean',
            'enable_on_register' => 'boolean',
            'enable_on_contact' => 'boolean',
        ]);
        
        // Set boolean fields to false if not present
        $validated['enabled'] = $request->has('enabled') ? 1 : 0;
        $validated['enable_on_login'] = $request->has('enable_on_login') ? 1 : 0;
        $validated['enable_on_register'] = $request->has('enable_on_register') ? 1 : 0;
        $validated['enable_on_contact'] = $request->has('enable_on_contact') ? 1 : 0;
        
        $settings = CaptchaSetting::first();
        
        if ($settings) {
            $settings->update($validated);
        } else {
            CaptchaSetting::create($validated);
        }
        
        // Update config at runtime
        config(['turnstile.turnstile_site_key' => $validated['site_key']]);
        config(['turnstile.turnstile_secret_key' => $validated['secret_key']]);
        
        return redirect()->route('admin.settings.captcha')->with('success', 'CAPTCHA settings have been updated.');
    }
}
