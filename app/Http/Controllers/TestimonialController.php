<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::active()->get();
        $averageRating = Testimonial::active()->avg('rating');
        $totalReviews = Testimonial::active()->count();

        return view('testimonials', compact('testimonials', 'averageRating', 'totalReviews'));
    }
}