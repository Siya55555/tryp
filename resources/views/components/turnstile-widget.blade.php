@php
    use Illuminate\Support\Facades\Route;
    $settings = \App\Models\Admin\CaptchaSetting::first();
    $currentRoute = Route::currentRouteName();
    
    $enabled = $settings && $settings->enabled && (
        ($settings->enable_on_login && $currentRoute === 'login') ||
        ($settings->enable_on_register && $currentRoute === 'register') ||
        ($settings->enable_on_contact && $currentRoute === 'contact.submit')
    );
@endphp

@if($settings && $settings->site_key)
    <div class="cf-turnstile mt-4 mb-2" data-sitekey="{{ $settings->site_key }}" data-theme="light"></div>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
@endif
