<?php

namespace App\Console\Commands;

use App\Models\Admin\CaptchaSetting;
use Illuminate\Console\Command;

class UpdateCaptchaKeys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'captcha:setup {site_key?} {secret_key?} {--enable} {--disable}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup or update Cloudflare Turnstile captcha keys';

    /**
     * Execute the console command.
     */    public function handle()
    {
        $settings = CaptchaSetting::first() ?? new CaptchaSetting();
        
        // Update site key if provided
        if ($siteKey = $this->argument('site_key')) {
            $settings->site_key = $siteKey;
            $this->info('Site key updated.');
        }
        
        // Update secret key if provided
        if ($secretKey = $this->argument('secret_key')) {
            $settings->secret_key = $secretKey;
            $this->info('Secret key updated.');
        }
        
        // Enable captcha if --enable option is used
        if ($this->option('enable')) {
            $settings->enabled = true;
            $this->info('Captcha enabled.');
        }
        
        // Disable captcha if --disable option is used
        if ($this->option('disable')) {
            $settings->enabled = false;
            $this->info('Captcha disabled.');
        }
        
        // Save changes
        $settings->save();
        
        // Show current settings
        $this->table(
            ['Setting', 'Value'],
            [
                ['Site Key', $settings->site_key ?: 'Not set'],
                ['Secret Key', $settings->secret_key ? '************' : 'Not set'],
                ['Enabled', $settings->enabled ? 'Yes' : 'No'],
                ['Enabled on Login', $settings->enable_on_login ? 'Yes' : 'No'],
                ['Enabled on Register', $settings->enable_on_register ? 'Yes' : 'No'],
                ['Enabled on Contact', $settings->enable_on_contact ? 'Yes' : 'No'],
            ]
        );
        
        $this->info('Captcha settings have been updated.');
    }
}
