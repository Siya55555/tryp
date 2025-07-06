<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TiersController;
use App\Http\Controllers\BundleController;
use App\Http\Controllers\CustomBundleController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\BlogCategoryController as AdminBlogCategoryController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use App\Http\Controllers\Admin\BundleController as AdminBundleController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\User\BookingController as UserBookingController;
use App\Http\Controllers\Admin\BundleExtraController;
use App\Http\Controllers\Api\ApiDestinationController;
use App\Http\Controllers\HotelController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Password Reset Routes
// Password Reset Routes
Route::get('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/verify', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showVerifyForm'])->name('password.verify');
Route::post('/reset-password/verify', [App\Http\Controllers\Auth\ResetPasswordController::class, 'verify'])->name('password.verify.post');
Route::get('/reset-password/create', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');


// Email Verification Routes
Route::get('/email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])
    ->name('verification.notice');
Route::post('/email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])
    ->name('verification.verify');
Route::post('/email/verification-notification', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])
    ->name('verification.resend');


// Contact Routes
Route::get('/contact', function () {
    return view('contact');
});
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');

// Newsletter Routes
Route::post('/newsletter/subscribe', [App\Http\Controllers\EmailSubscriptionController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{token}', [App\Http\Controllers\EmailSubscriptionController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// Newsletter Subscription Routes
Route::get('/unsubscribe/{token}', [\App\Http\Controllers\EmailSubscriptionController::class, 'unsubscribe'])
    ->name('email-subscriptions.unsubscribe');
Route::get('/unsubscribe', [\App\Http\Controllers\EmailSubscriptionController::class, 'showUnsubscribeForm'])
    ->name('unsubscribe.form');
Route::post('/unsubscribe/{token}', [\App\Http\Controllers\EmailSubscriptionController::class, 'processUnsubscribe'])
    ->name('unsubscribe.process');

// FAQ and Testimonials Routes
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials');

Route::get('/privacy-policy', [App\Http\Controllers\PrivacyController::class, 'index'])->name('privacy-policy');


// Blog Routes
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/search', [BlogController::class, 'search'])->name('search');
    Route::get('/category/{slug}', [BlogController::class, 'category'])->name('category');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
    Route::post('/{id}/comment', [BlogController::class, 'storeComment'])->name('comment');
});

// Destination Routes - NEW
Route::prefix('destinations')->name('destinations.')->group(function () {
    Route::get('/search', [DestinationController::class, 'search'])->name('search');
    Route::get('/{id}', [DestinationController::class, 'show'])->name('show');
});

// API Routes for Destination Search - NEW
Route::prefix('api')->group(function () {
    Route::get('/destinations/search', [ApiDestinationController::class, 'search']);
    Route::get('/payment-gateways', [App\Http\Controllers\PaymentController::class, 'getActiveGateways']);
    Route::post('/process-payment', [App\Http\Controllers\PaymentController::class, 'processPayment']);
});

// Payment Routes
Route::prefix('payment')->name('payment.')->group(function () {
    Route::get('/checkout', [App\Http\Controllers\PaymentController::class, 'checkout'])->name('checkout');
    Route::get('/success', [App\Http\Controllers\PaymentController::class, 'success'])->name('success');
    Route::get('/cancel', [App\Http\Controllers\PaymentController::class, 'cancel'])->name('cancel');
});

// Tiers routes
Route::get('/tiers', [TiersController::class, 'index'])->name('tiers.index');
Route::get('/tiers/{type}', [TiersController::class, 'show'])->name('tiers.show');
Route::post('/tiers/book', [TiersController::class, 'book'])->name('tiers.book');
Route::get('/thank-you', [TiersController::class, 'thankYou'])->name('tiers.thankyou');

// Vacation Bundles routes
Route::prefix('bundles')->name('bundles.')->group(function () {
    Route::get('/', [BundleController::class, 'index'])->name('index');
    Route::get('/{slug}', [BundleController::class, 'show'])->name('show');
    Route::post('/{id}/inquiry', [BundleController::class, 'inquiry'])->name('inquiry');
});
// Custom Bundles routes
Route::get('/custom-bundles', [CustomBundleController::class, 'index'])
     ->name('custom-bundles');
     
// New consolidated builder route
Route::get('/custom-bundles/{type?}', [CustomBundleController::class, 'builder'])
     ->name('custom-bundle.builder')
     ->where('type', 'domestic|international|combination');

Route::post('/custom-bundles/build', [CustomBundleController::class, 'build'])
     ->name('custom-bundle.build');

// Dynamic CSS Route for Button Colors
Route::get('/css/dynamic-styles.css', [AdminSettingsController::class, 'generateDynamicCSS'])
     ->name('dynamic.css');

// Test route for button colors
Route::get('/test-buttons', function () {
    return view('test-buttons');
})->name('test.buttons');
     
// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/bookings-dashboard', [AdminDashboardController::class, 'bookingsDashboard'])->name('bookings.dashboard');
    
    // Add this to the admin routes section in web.php
    Route::resource('navigation', \App\Http\Controllers\Admin\NavigationController::class);
    Route::post('navigation/update-order', [\App\Http\Controllers\Admin\NavigationController::class, 'updateOrder'])->name('navigation.update-order');

    // Blog Management
    Route::resource('blogs', AdminBlogController::class);
    Route::resource('blog-categories', AdminBlogCategoryController::class);
    Route::resource('tags', AdminTagController::class);
    
    // Bundle Management
    Route::resource('bundles', AdminBundleController::class);
    Route::resource('destinations', AdminDestinationController::class);
      // User Management
    Route::resource('users', AdminUserController::class);
    Route::get('users/{user}/bookings', [AdminUserController::class, 'bookings'])->name('users.bookings');
    Route::get('users/{user}/check-bookings', [AdminUserController::class, 'checkBookings'])->name('users.check-bookings');
    Route::post('users/{user}/impersonate', [AdminUserController::class, 'impersonate'])->name('users.impersonate');

    Route::post('users/{user}/send-verification', [AdminUserController::class, 'sendVerification'])
    ->name('users.send-verification');

    // Booking Routes - UPDATED
    // Include all booking routes from separate file for better organization
    require __DIR__.'/admin/bookings.php';
    
    // Bundle Extras Routes
    Route::get('bundle-extras', [BundleExtraController::class, 'index'])->name('bundle-extras.index');
    Route::get('bundle-extras/create', [BundleExtraController::class, 'create'])->name('bundle-extras.create');
    Route::post('bundle-extras', [BundleExtraController::class, 'store'])->name('bundle-extras.store');
    Route::get('bundle-extras/{bundleExtra}/edit', [BundleExtraController::class, 'edit'])->name('bundle-extras.edit');
    Route::put('bundle-extras/{bundleExtra}', [BundleExtraController::class, 'update'])->name('bundle-extras.update');
    Route::delete('bundle-extras/{bundleExtra}', [BundleExtraController::class, 'destroy'])->name('bundle-extras.destroy');
    
    // AJAX route for getting bundle extras
    Route::get('bundle-extras/get-by-bundle', [BundleExtraController::class, 'getBundleExtras'])->name('bundle-extras.get-by-bundle');
    
    // Testimonials Management
    Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class);
    
    // FAQs Management
    Route::resource('faqs', \App\Http\Controllers\Admin\FaqController::class);
    Route::post('faqs/reorder', [\App\Http\Controllers\Admin\FaqController::class, 'reorder'])->name('faqs.reorder');

    // Custom Bundles Management
    Route::resource('custom-bundles', \App\Http\Controllers\Admin\CustomBundleController::class, [
        'parameters' => ['custom-bundles' => 'customBundle']
    ]);
    Route::get('custom-bundles/generate-slug', [\App\Http\Controllers\Admin\CustomBundleController::class, 'generateSlug'])->name('custom-bundles.generate-slug');
    Route::get('custom-bundles-destinations', [\App\Http\Controllers\Admin\CustomBundleController::class, 'manageDestinations'])->name('custom-bundles.manage-destinations');
    Route::post('custom-bundles-destinations', [\App\Http\Controllers\Admin\CustomBundleController::class, 'updateDestinations'])->name('custom-bundles.update-destinations');    // Site Settings Routes
    Route::get('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/general', [App\Http\Controllers\Admin\SettingsController::class, 'updateGeneral'])->name('settings.update.general');
    Route::post('/settings/appearance', [App\Http\Controllers\Admin\SettingsController::class, 'updateAppearance'])->name('settings.update.appearance');    Route::post('/settings/contact', [App\Http\Controllers\Admin\SettingsController::class, 'updateContact'])->name('settings.update.contact');
    Route::post('/settings/display', [App\Http\Controllers\Admin\SettingsController::class, 'updateDisplay'])->name('settings.update.display');
    Route::get('/settings/captcha', [App\Http\Controllers\Admin\CaptchaSettingsController::class, 'edit'])->name('settings.captcha');
    Route::post('/settings/captcha', [App\Http\Controllers\Admin\CaptchaSettingsController::class, 'update'])->name('settings.captcha.update');

    // Add these routes
    Route::get('/contact-settings', [App\Http\Controllers\Admin\ContactSettingsController::class, 'index'])
     ->name('contact-settings.index');
    Route::put('/contact-settings', [App\Http\Controllers\Admin\ContactSettingsController::class, 'update'])
     ->name('contact-settings.update');
   
    // Travel Packages Management
    Route::resource('travel-packages', \App\Http\Controllers\Admin\TravelPackageController::class);
    Route::post('travel-packages/update-order', [\App\Http\Controllers\Admin\TravelPackageController::class, 'updateOrder'])
        ->name('travel-packages.update-order');
        
    Route::resource('privacy', \App\Http\Controllers\Admin\PrivacyController::class);

    // Deal of the Week Routes
    Route::resource('deals', \App\Http\Controllers\Admin\DealOfWeekController::class);
    Route::post('deals/{deal}/set-active', [\App\Http\Controllers\Admin\DealOfWeekController::class, 'setActive'])->name('deals.set-active');

    Route::get('/contact-submissions', [App\Http\Controllers\Admin\ContactSubmissionsController::class, 'index'])
    ->name('contact-submissions.index');
    
    Route::get('/contact-submissions/{id}', [App\Http\Controllers\Admin\ContactSubmissionsController::class, 'show'])
        ->name('contact-submissions.show');
        
    Route::post('/contact-submissions/{id}/reply', [App\Http\Controllers\Admin\ContactSubmissionsController::class, 'reply'])
        ->name('contact-submissions.reply');
        
    Route::delete('/contact-submissions/{id}', [App\Http\Controllers\Admin\ContactSubmissionsController::class, 'destroy'])
        ->name('contact-submissions.destroy');

    Route::post('/settings/hero', [App\Http\Controllers\Admin\SettingsController::class, 'updateHero'])->name('settings.update.hero');

    # Add these routes inside the admin routes group in web.php:
    # Add this line inside the admin routes group in web.php:

    Route::resource('why-choose-us', \App\Http\Controllers\Admin\WhyChooseUsController::class, [
        'parameters' => ['why-choose-us' => 'whyChooseUs']
    ]);    Route::post('why-choose-us/update-order', [\App\Http\Controllers\Admin\WhyChooseUsController::class, 'updateOrder'])->name('why-choose-us.update-order');
      // Payment Gateway Management
    Route::resource('payment-gateways', \App\Http\Controllers\Admin\PaymentGatewayController::class);
    
    // Email Subscriptions Management
    Route::get('/email-subscriptions', [\App\Http\Controllers\Admin\EmailSubscriptionController::class, 'index'])->name('email-subscriptions.index');
    Route::patch('/email-subscriptions/{subscription}/status', [\App\Http\Controllers\Admin\EmailSubscriptionController::class, 'updateStatus'])->name('email-subscriptions.update-status');
    Route::delete('/email-subscriptions/{subscription}', [\App\Http\Controllers\Admin\EmailSubscriptionController::class, 'destroy'])->name('email-subscriptions.destroy');
    Route::post('/email-subscriptions/bulk-action', [\App\Http\Controllers\Admin\EmailSubscriptionController::class, 'bulkAction'])->name('email-subscriptions.bulk-action');
    Route::get('/email-subscriptions/compose', [\App\Http\Controllers\Admin\EmailSubscriptionController::class, 'composeNewsletter'])->name('email-subscriptions.compose');
    Route::post('/email-subscriptions/send', [\App\Http\Controllers\Admin\EmailSubscriptionController::class, 'sendNewsletter'])->name('email-subscriptions.send');
    Route::get('/email-subscriptions/get-subscriptions', [\App\Http\Controllers\Admin\EmailSubscriptionController::class, 'getSubscriptions'])->name('email-subscriptions.get-subscriptions');

    // Admin Hotels CRUD
    Route::resource('hotels', App\Http\Controllers\Admin\HotelController::class);

    // Custom Pages Management
    Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
});

// User Dashboard Routes
Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    Route::get('/', [UserDashboardController::class, 'index'])->name('dashboard');
    
    // Profile Management
    Route::get('/profile', [UserProfileController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/password', [UserProfileController::class, 'updatePassword'])->name('password.update');
    
    // Bookings
    Route::get('/bookings', [UserBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [UserBookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [UserBookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [UserBookingController::class, 'show'])->name('bookings.show');
    Route::patch('/bookings/{booking}/cancel', [UserBookingController::class, 'cancel'])->name('bookings.cancel');
    Route::get('/bookings/{booking}/download', [UserBookingController::class, 'download'])->name('bookings.download');
});

// User-facing hotels
Route::get('/destinations/{destination}/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');

// User-facing custom page route (must be last to avoid conflicts)
Route::get('/pages/{slug}', [\App\Http\Controllers\PageController::class, 'show'])->name('pages.show');