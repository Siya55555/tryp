<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\CaptchaSetting;

class CloudflareTurnstileSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CaptchaSetting::firstOrCreate(
            ['id' => 1],
            [
                'site_key' => env('TURNSTILE_SITE_KEY', ''),
                'secret_key' => env('TURNSTILE_SECRET_KEY', ''),
                'enabled' => true,
                'enable_on_login' => true,
                'enable_on_register' => true,
                'enable_on_contact' => true,
            ]
        );
    }
}