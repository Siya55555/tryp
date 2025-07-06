<?php
require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;

$app = new Application(realpath(__DIR__));
$app->singleton(
    \Illuminate\Contracts\Http\Kernel::class,
    \App\Http\Kernel::class
);
$app->singleton(
    \Illuminate\Contracts\Console\Kernel::class,
    \App\Console\Kernel::class
);
$app->singleton(
    \Illuminate\Contracts\Debug\ExceptionHandler::class,
    \App\Exceptions\Handler::class
);

$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$app->loadEnvironmentFrom('.env');
$app->bootstrapWith([
    \Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables::class,
    \Illuminate\Foundation\Bootstrap\LoadConfiguration::class,
    \Illuminate\Foundation\Bootstrap\HandleExceptions::class,
    \Illuminate\Foundation\Bootstrap\RegisterFacades::class,
    \Illuminate\Foundation\Bootstrap\RegisterProviders::class,
    \Illuminate\Foundation\Bootstrap\BootProviders::class,
]);

// Test gradient settings
use App\Models\Setting;

echo "Testing Gradient Button Settings:\n";
echo "=================================\n";

$gradientSettings = [
    'primary_gradient_from',
    'primary_gradient_to', 
    'primary_gradient_hover_from',
    'primary_gradient_hover_to',
    'secondary_gradient_from',
    'secondary_gradient_to',
    'secondary_gradient_hover_from', 
    'secondary_gradient_hover_to'
];

foreach ($gradientSettings as $key) {
    $value = Setting::where('key', $key)->value('value');
    echo "{$key}: {$value}\n";
}

echo "\nDynamic CSS Test:\n";
echo "================\n";

// Test the CSS generation
$controller = new \App\Http\Controllers\Admin\SettingsController();
$cssContent = $controller->generateDynamicCSS();
echo substr($cssContent, 0, 500) . "...\n";
