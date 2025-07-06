<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\Admin\WhyChooseUs; // Add this import

class BundleController extends Controller
{
    /**
     * Display a listing of the bundles.
     */
    public function index()
    {
        $bundles = Bundle::with(['destinations'])
            ->orderBy('created_at', 'desc')
            ->paginate(9);
    
        $testimonials = Testimonial::active()
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();
    

        $whyChooseUs = WhyChooseUs::where('active', true)
                            ->orderBy('sort_order')
                            ->get();
        return view('bundles.index', compact('bundles', 'testimonials','whyChooseUs'));
    }

    /**
     * Display the specified bundle.
     */
    public function show($slug)
    {
        $bundle = Bundle::with(['destinations', 'extras'])
            ->where('slug', $slug)
            ->firstOrFail();

        $testimonials = Testimonial::active()
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        $whyChooseUs = WhyChooseUs::where('active', true)
            ->orderBy('sort_order')
            ->get();

        return view('bundles.show', compact('bundle', 'testimonials','whyChooseUs'));
    }

    /**
     * Handle a bundle inquiry form submission.
     */
    public function inquiry(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'nullable|string',
            'consent' => 'required|accepted',
        ]);

        // Here you would typically:
        // 1. Save inquiry to database
        // 2. Send notification emails
        // 3. Create a lead in your CRM
        // For now, we'll just redirect with success message

        return redirect()
            ->back()
            ->with('success', 'Thank you for your inquiry! Our team will contact you shortly.');
    }
}