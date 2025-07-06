<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Admin\Setting;
use App\Models\Admin\NavigationItem;
use App\Observers\NavigationItemObserver;
use App\Services\NavigationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the NavigationService
        $this->app->singleton(NavigationService::class, function ($app) {
            return new NavigationService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \URL::forceScheme('https');
        // Register the NavigationItemObserver
        NavigationItem::observe(NavigationItemObserver::class);

        // Share all settings with views
        View::composer('*', function ($view) {
            // Get all settings from database
            $allSettings = Setting::all()->pluck('value', 'key')->toArray();
            
            // Process logo URL to ensure it's absolute
            if (isset($allSettings['site_logo'])) {
                $logoPath = $allSettings['site_logo'];
                
                // If not already an absolute URL and not starting with /
                if (!preg_match('/^https?:\/\//', $logoPath) && substr($logoPath, 0, 1) !== '/') {
                    $allSettings['site_logo'] = '/' . $logoPath;
                }
            }
            
            $view->with('settings', $allSettings);
        });

        // Share navigation items with header view
        View::composer('components.header', function ($view) {
            $navigationService = app(NavigationService::class);
            $view->with('mainNavigation', $navigationService->getMainNav());
        });

        try {
            $contactSettings = \App\Models\Admin\ContactSettings::first();
            if ($contactSettings) {
                $contactSettings->applyMailConfig();
            }
        } catch (\Exception $e) {
            // Log error or handle as needed
        }
    }
}