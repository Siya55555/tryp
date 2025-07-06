<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Destination;
use App\Models\Admin\Bundle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Destination::with('bundle');
        
        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Filter by bundle
        if ($request->has('bundle') && $request->bundle != '') {
            $query->where('bundle_id', $request->bundle);
        }
        
        $destinations = $query->latest()->paginate(10);
        $bundles = Bundle::all();
        
        return view('admin.destinations.index', compact('destinations', 'bundles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bundles = Bundle::all();
        return view('admin.destinations.create', compact('bundles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bundle_id' => 'required|exists:bundles,id',
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'main_image' => 'required_without:image_urls|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'included_items' => 'required|array|min:1',
            'included_items.*' => 'required|string|max:255',
            'restrictions' => 'nullable|string',
            'image_urls' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Process images
        $mainImagePath = null;
        $galleryImages = [];

        // Process main image from file upload
        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->store('destinations', 'public');
            $mainImagePath = Storage::url($mainImagePath);
        }

        // Process gallery images from file uploads
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('destinations/gallery', 'public');
                $galleryImages[] = Storage::url($path);
            }
        }

        // Process images from URLs if no files uploaded
        if (empty($mainImagePath) && !empty($request->image_urls)) {
            $urls = explode("\n", $request->image_urls);
            $urls = array_map('trim', $urls);
            $urls = array_filter($urls);
            
            if (!empty($urls)) {
                $mainImagePath = $urls[0];
                $galleryImages = array_slice($urls, 1);
            }
        }

        // Create destination
        $destination = Destination::create([
            'bundle_id' => $request->bundle_id,
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'main_image' => $mainImagePath,
            'included_items' => json_encode($request->included_items),
            'restrictions' => $request->restrictions,
            'gallery' => json_encode($galleryImages),
        ]);

        return redirect()
            ->route('admin.destinations.index')
            ->with('success', 'Destination created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function show(Destination $destination)
    {
        return redirect()->route('admin.destinations.edit', $destination);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function edit(Destination $destination)
    {
        $bundles = Bundle::all();
        return view('admin.destinations.edit', compact('destination', 'bundles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destination $destination)
{
    $validator = Validator::make($request->all(), [
        'bundle_id' => 'required|exists:bundles,id',
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'description' => 'required|string',
        'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'main_image_url' => 'nullable|url',
        'gallery_images' => 'nullable|array',
        'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'gallery_image_urls' => 'nullable|string',
        'included_items' => 'required|array|min:1',
        'included_items.*' => 'required|string|max:255',
        'restrictions' => 'nullable|string',
        'remove_gallery' => 'nullable|array',
        'remove_gallery.*' => 'nullable|integer',
    ]);

    if ($validator->fails()) {
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Handle main image update
    $mainImagePath = $destination->main_image;
    if ($request->hasFile('main_image') && $request->file('main_image')->isValid()) {
        // Delete old image if it's a local file
        if (strpos($destination->main_image, '/storage/') === 0) {
            $oldPath = str_replace('/storage/', 'public/', $destination->main_image);
            Storage::delete($oldPath);
        }
        
        // Store new image
        $path = $request->file('main_image')->store('destinations', 'public');
        $mainImagePath = Storage::url($path);
    } elseif ($request->filled('main_image_url')) {
        $mainImagePath = $request->main_image_url;
    }

    // Handle gallery images
    $galleryImages = is_array($destination->gallery) ? $destination->gallery : (is_string($destination->gallery) ? json_decode($destination->gallery, true) : []);
    $galleryImages = $galleryImages ?? [];
    
    // Remove selected gallery images
    if ($request->has('remove_gallery')) {
        foreach ($request->remove_gallery as $index) {
            if (isset($galleryImages[$index])) {
                // Delete file if it's a local file
                if (strpos($galleryImages[$index], '/storage/') === 0) {
                    $oldPath = str_replace('/storage/', 'public/', $galleryImages[$index]);
                    Storage::delete($oldPath);
                }
                
                unset($galleryImages[$index]);
            }
        }
        $galleryImages = array_values($galleryImages); // Re-index array
    }
    
    // Add new gallery images from file upload
    if ($request->hasFile('gallery_images')) {
        foreach ($request->file('gallery_images') as $image) {
            if ($image->isValid()) {
                $path = $image->store('destinations/gallery', 'public');
                $galleryImages[] = Storage::url($path);
            }
        }
    }

    // Add new gallery images from URLs
    if ($request->filled('gallery_image_urls')) {
        $urls = explode("\n", $request->gallery_image_urls);
        $urls = array_map('trim', $urls);
        $urls = array_filter($urls);
        
        foreach ($urls as $url) {
            $galleryImages[] = $url;
        }
    }

    // Update destination
    $destination->update([
        'bundle_id' => $request->bundle_id,
        'name' => $request->name,
        'location' => $request->location,
        'description' => $request->description,
        'main_image' => $mainImagePath,
        'included_items' => json_encode($request->included_items),
        'restrictions' => $request->restrictions,
        'gallery' => json_encode($galleryImages),
    ]);

    return redirect()
        ->route('admin.destinations.index')
        ->with('success', 'Destination updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destination $destination)
    {
        // Delete associated images if they're local files
        if (strpos($destination->main_image, '/storage/') === 0) {
            $mainImagePath = str_replace('/storage/', 'public/', $destination->main_image);
            Storage::delete($mainImagePath);
        }
        
        $gallery = json_decode($destination->gallery, true) ?? [];
        foreach ($gallery as $image) {
            if (strpos($image, '/storage/') === 0) {
                $path = str_replace('/storage/', 'public/', $image);
                Storage::delete($path);
            }
        }
        
        $destination->delete();
        
        return redirect()
            ->route('admin.destinations.index')
            ->with('success', 'Destination deleted successfully.');
    }
}