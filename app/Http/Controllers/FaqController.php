<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{    public function index()
    {
        // Fetch active FAQs, grouped by category
        $faqCategories = Faq::active()
            ->ordered()
            ->get()
            ->groupBy('category');

        // Add SEO metadata
        $seoTitle = 'Frequently Asked Questions - Travel Help & Support';
        $seoDescription = 'Find answers to your travel booking questions. Our comprehensive FAQ covers booking, payments, destinations, cancellations, and more.';
        $seoKeywords = 'travel FAQ, vacation questions, booking help, travel support, cancellation policy, payment questions';
        $seoImage = asset('images/default-social-share.jpg');
        $seoType = 'website';
        $canonicalUrl = route('faq');

        return view('faq', compact('faqCategories', 'seoTitle', 'seoDescription', 'seoKeywords', 'seoImage', 'seoType', 'canonicalUrl'));
    }
}