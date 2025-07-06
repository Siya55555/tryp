<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Testimonial::query();
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $testimonials = $query->latest()->paginate(10);
        
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'rating' => 'required|numeric|min:0|max:5',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url',
            'status' => 'required|in:active,inactive',
        ]);
        
        $testimonialData = [
            'name' => $request->name,
            'description' => $request->description,
            'rating' => $request->rating,
            'location' => $request->location,
            'status' => $request->status,
        ];
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/testimonials'), $filename);
            $testimonialData['image'] = 'storage/testimonials/' . $filename;
        } elseif ($request->filled('image_url')) {
            $testimonialData['image'] = $request->image_url;
        }

        Testimonial::create($testimonialData);
        
        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'rating' => 'required|numeric|min:0|max:5',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url',
            'status' => 'required|in:active,inactive',
        ]);
        
        $testimonialData = [
            'name' => $request->name,
            'description' => $request->description,
            'rating' => $request->rating,
            'location' => $request->location,
            'status' => $request->status,
        ];
        
        if ($request->hasFile('image')) {
            // Delete old image
            if ($testimonial->image && !filter_var($testimonial->image, FILTER_VALIDATE_URL)) {
                $oldImagePath = public_path($testimonial->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/testimonials'), $filename);
            $testimonialData['image'] = 'storage/testimonials/' . $filename;
        } elseif ($request->filled('image_url')) {
            // Delete old image
            if ($testimonial->image && !filter_var($testimonial->image, FILTER_VALIDATE_URL)) {
                $oldImagePath = public_path($testimonial->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $testimonialData['image'] = $request->image_url;
        }
        
        $testimonial->update($testimonialData);
        
        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        // Delete associated image if it's not a URL
        if ($testimonial->image && !filter_var($testimonial->image, FILTER_VALIDATE_URL)) {
            $imagePath = public_path($testimonial->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        
        $testimonial->delete();
        
        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }
}