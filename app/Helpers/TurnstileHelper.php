<?php

namespace App\Helpers;

use App\Models\Admin\CaptchaSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TurnstileHelper
{
    /**
     * Verify a Turnstile token
     *
     * @param string $token
     * @param string|null $remoteIp
     * @return bool
     */
    public static function verify($token, $remoteIp = null)
    {
        if (empty($token)) {
            return false;
        }

        try {
            $settings = CaptchaSetting::first();
            
            if (!$settings || !$settings->enabled || empty($settings->secret_key)) {
                return true; // Skip verification if Turnstile is not configured
            }

            $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                'secret' => $settings->secret_key,
                'response' => $token,
                'remoteip' => $remoteIp ?? request()->ip(),
            ]);

            $result = $response->json();
            
            return $result['success'] ?? false;
        } catch (\Exception $e) {
            Log::error('Turnstile verification error: ' . $e->getMessage());
            return false;
        }
    }
}
