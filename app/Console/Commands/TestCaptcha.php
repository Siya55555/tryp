<?php

namespace App\Console\Commands;

use App\Models\Admin\CaptchaSetting;
use Illuminate\Console\Command;

class TestCaptcha extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'captcha:test {token?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the Cloudflare Turnstile integration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing Cloudflare Turnstile integration...');
        
        $settings = CaptchaSetting::first();
        
        if (!$settings) {
            $this->error('No captcha settings found. Run php artisan captcha:setup first.');
            return 1;
        }
        
        $this->table(
            ['Setting', 'Value'],
            [
                ['Site Key', $settings->site_key ?: 'Not set'],
                ['Secret Key', $settings->secret_key ? 'Set (hidden)' : 'Not set'],
                ['Enabled', $settings->enabled ? 'Yes' : 'No'],
                ['Enabled on Login', $settings->enable_on_login ? 'Yes' : 'No'],
                ['Enabled on Register', $settings->enable_on_register ? 'Yes' : 'No'],
                ['Enabled on Contact', $settings->enable_on_contact ? 'Yes' : 'No'],
            ]
        );
        
        $token = $this->argument('token');
        
        if ($token) {
            $this->info('Testing token verification...');
            $result = \App\Helpers\TurnstileHelper::verify($token);
            if ($result) {
                $this->info('✓ Token verification successful!');
            } else {
                $this->error('✗ Token verification failed!');
            }
        }
        
        $this->info('Integration test completed.');
        
        return 0;
    }
}
