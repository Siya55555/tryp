<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use App\Models\Admin\Bundle;
use App\Models\Admin\BundleExtra;
use App\Models\Admin\UserBooking;
use App\Models\User;
use App\Models\Admin\Testimonial;
use App\Models\Admin\Faq;
use App\Models\Admin\DealOfWeek;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic stats
        $bundleBookingsCount = UserBooking::count();
        $packageBookingsCount = 0;
        
        // Check if the Booking class exists and tier_bookings table exists
        $bookingClassExists = class_exists('\\App\\Models\\Booking');
        $tierBookingsTableExists = Schema::hasTable('tier_bookings');
        
        if ($bookingClassExists && $tierBookingsTableExists) {
            $packageBookingsCount = \App\Models\Booking::count();
        }
        
        $totalBookings = $bundleBookingsCount + $packageBookingsCount;
        
        // Status counts
        $pendingBundleBookings = UserBooking::where('status', 'pending')->count();
        $pendingPackageBookings = 0;
        $confirmedBundleBookings = UserBooking::where('status', 'confirmed')->count();
        $confirmedPackageBookings = 0;
        
        if ($bookingClassExists && $tierBookingsTableExists) {
            $pendingPackageBookings = \App\Models\Booking::where('status', 'pending')->count();
            $confirmedPackageBookings = \App\Models\Booking::where('status', 'confirmed')->count();
        }
        
        $pendingBookings = $pendingBundleBookings + $pendingPackageBookings;
        $confirmedBookings = $confirmedBundleBookings + $confirmedPackageBookings;
        
        // Revenue calculations
        $bundleRevenue = UserBooking::join('bundles', 'user_bookings.bundle_id', '=', 'bundles.id')
            ->where('user_bookings.status', 'confirmed')
            ->select(DB::raw('SUM(bundles.price * user_bookings.number_of_people) as total_revenue'))
            ->first()->total_revenue ?? 0;
            
        $packageRevenue = 0;
        if ($bookingClassExists && $tierBookingsTableExists) {
            $packageRevenue = \App\Models\Booking::where('status', 'confirmed')
                ->sum('package_price');
        }
            
        $totalRevenue = $bundleRevenue + $packageRevenue;
        
        // Combined recent bookings
        $recentBundleBookings = UserBooking::with(['user', 'bundle'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $recentPackageBookings = collect([]);
        if ($bookingClassExists && $tierBookingsTableExists) {
            $recentPackageBookings = \App\Models\Booking::orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        }
            
        $recentBookings = $recentBundleBookings->concat($recentPackageBookings)
            ->sortByDesc('created_at')
            ->take(10);
        
        $stats = [
            'blogs' => Blog::count(),
            'bundles' => Bundle::count(),
            'users' => User::count(),
            'bundle_extras' => BundleExtra::count(),
            'testimonials' => Testimonial::count(),
            'faqs' => Faq::count(),
            'deals' => DealOfWeek::count(),
            'contacts' => ContactSubmission::count(),
            'new_contacts' => ContactSubmission::where('status', 'new')->count(),
            
            // Booking specific stats
            'total_bookings' => $totalBookings,
            'pending_bookings' => $pendingBookings,
            'confirmed_bookings' => $confirmedBookings,
            'total_revenue' => $totalRevenue,
            'bundle_bookings' => $bundleBookingsCount,
            'package_bookings' => $packageBookingsCount
        ];
        
        $recentBlogs = Blog::orderBy('created_at', 'desc')->take(5)->get();
        $recentBundles = Bundle::orderBy('created_at', 'desc')->take(5)->get();
        $recentBundleExtras = BundleExtra::with('bundle')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $recentTestimonials = Testimonial::orderBy('created_at', 'desc')->take(5)->get();
        $recentFaqs = Faq::orderBy('created_at', 'desc')->take(5)->get();
        $recentDeals = DealOfWeek::orderBy('created_at', 'desc')->take(3)->get();
        $recentContacts = ContactSubmission::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'stats', 
            'recentBlogs', 
            'recentBundles', 
            'recentBundleExtras',
            'recentTestimonials',
            'recentFaqs',
            'recentDeals',
            'recentContacts',
            'recentBookings'
        ));
    }
    
    /**
     * Display a bookings dashboard widget
     */
    public function bookingsDashboard()
    {
        // Check if the Booking class exists and tier_bookings table exists
        $bookingClassExists = class_exists('\\App\\Models\\Booking');
        $tierBookingsTableExists = Schema::hasTable('tier_bookings');
        
        // Status counts
        $pendingBundleBookings = UserBooking::where('status', 'pending')->count();
        $pendingPackageBookings = 0;
        $confirmedBundleBookings = UserBooking::where('status', 'confirmed')->count();
        $confirmedPackageBookings = 0;
        
        if ($bookingClassExists && $tierBookingsTableExists) {
            $pendingPackageBookings = \App\Models\Booking::where('status', 'pending')->count();
            $confirmedPackageBookings = \App\Models\Booking::where('status', 'confirmed')->count();
        }
        
        $pendingBookings = $pendingBundleBookings + $pendingPackageBookings;
        $confirmedBookings = $confirmedBundleBookings + $confirmedPackageBookings;
        
        // Revenue calculations
        $bundleRevenue = UserBooking::join('bundles', 'user_bookings.bundle_id', '=', 'bundles.id')
            ->where('user_bookings.status', 'confirmed')
            ->select(DB::raw('SUM(bundles.price * user_bookings.number_of_people) as total_revenue'))
            ->first()->total_revenue ?? 0;
            
        $packageRevenue = 0;
        if ($bookingClassExists && $tierBookingsTableExists) {
            $packageRevenue = \App\Models\Booking::where('status', 'confirmed')
                ->sum('package_price');
        }
            
        $totalRevenue = $bundleRevenue + $packageRevenue;
        
        // Combined recent bookings
        $recentBundleBookings = UserBooking::with(['user', 'bundle'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $recentPackageBookings = collect([]);
        if ($bookingClassExists && $tierBookingsTableExists) {
            $recentPackageBookings = \App\Models\Booking::orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        }
            
        $recentBookings = $recentBundleBookings->concat($recentPackageBookings)
            ->sortByDesc('created_at')
            ->take(10);
        
        $stats = [
            'total_bookings' => UserBooking::count() + ($bookingClassExists && $tierBookingsTableExists ? \App\Models\Booking::count() : 0),
            'pending_bookings' => $pendingBookings,
            'confirmed_bookings' => $confirmedBookings,
            'total_revenue' => $totalRevenue,
        ];
        
        return view('admin.bookings.dashboard_widget', compact('recentBookings', 'stats'));
    }
}