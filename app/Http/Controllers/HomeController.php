<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Bundle;
use App\Models\Admin\Destination;
use App\Models\Admin\Testimonial;
use App\Models\Admin\DealOfWeek;
use App\Models\Admin\WhyChooseUs;
use App\Models\Admin\Setting;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Get display count settings (with defaults if not set)
        $bundlesCount = (int) Setting::get('home_bundles_count', 6);
        $destinationsCount = (int) Setting::get('home_destinations_count', 6);
        $testimonialsCount = (int) Setting::get('testimonials_count', 8);
        
        // Get featured bundles
        $bundles = Bundle::where('status', 'active')
                        ->orderBy('created_at', 'desc')
                        ->take($bundlesCount)
                        ->get();
        
        // Get popular destinations
        $destinations = Destination::orderBy('created_at', 'desc')
                             ->take($destinationsCount)
                             ->get();
        
        // Get testimonials
        $testimonials = Testimonial::where('status', 'active')
                                 ->orderBy('created_at', 'desc')
                                 ->take($testimonialsCount)
                                 ->get();
        
        // Get active deal of the week
        $deal = DealOfWeek::where('status', 'active')
                        ->where(function($query) {
                            $query->whereNull('expires_at')
                                  ->orWhere('expires_at', '>', Carbon::now());
                        })
                        ->first();
          // Get "Why Choose Us" features
        $whyChooseUs = WhyChooseUs::where('active', true)
                                ->orderBy('sort_order')
                                ->get();
        
        // Add SEO metadata
        $siteName = Setting::get('site_name', 'MyTravel');
        $siteTagline = Setting::get('site_tagline', 'Book Your Perfect Vacation');
        
        $seoTitle = $siteName . ' - ' . $siteTagline;
        $seoDescription = Setting::get('home_seo_description', 
            'Find and book your perfect vacation packages with ' . $siteName . '. Explore top destinations worldwide, exclusive deals, and personalized travel experiences.');
        $seoKeywords = Setting::get('home_seo_keywords', 
            'travel booking, vacation packages, holiday deals, travel destinations, ' . $siteName . ', luxury travel');
        $seoImage = Setting::get('home_seo_image', asset('images/default-social-share.jpg'));
        $seoType = 'website';
        $canonicalUrl = route('home');
        
        return view('home', compact('bundles', 'destinations', 'testimonials', 'deal', 'whyChooseUs',
            'seoTitle', 'seoDescription', 'seoKeywords', 'seoImage', 'seoType', 'canonicalUrl'));
    }
}