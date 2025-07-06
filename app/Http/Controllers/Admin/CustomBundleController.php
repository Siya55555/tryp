<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Destination;
use App\Models\Admin\BundleType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CustomBundleController extends Controller
{
    /**
     * Display a listing of bundle types
     */
    public function index(Request $request)
    {
        $bundleTypes = BundleType::orderBy('name')->get();
        
        return view('admin.custom-bundles.index', compact('bundleTypes'));
    }

    /**
     * Show the form for creating a new bundle type
     */
    public function create()
    {
        return view('admin.custom-bundles.create');
    }

    /**
     * Store a newly created bundle type
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9-]+$/',
                'unique:bundle_types'
            ],
            'active' => 'boolean',
            'features_text' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url'
        ], [
            'slug.regex' => 'The slug may only contain lowercase letters, numbers, and hyphens.'
        ]);
    
        // Process features if submitted as strings
        $features = [];
        if ($request->has('features_text')) {
            $featuresText = explode("\n", $request->features_text);
            foreach ($featuresText as $feature) {
                $feature = trim($feature);
                if (!empty($feature)) {
                    $features[] = $feature;
                }
            }
        }
    
        // Handle image upload or URL
        $imagePath = null;
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/custom_bundle_images'), $filename);
            $imagePath = 'storage/custom_bundle_images/' . $filename;
        } elseif ($request->filled('image_url')) {
            $imagePath = $request->featured_image_url;
        }
        BundleType::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'slug' => $request->slug,
            'active' => $request->has('active'),
            'features' => $features,
            'image' => $imagePath
        ]);
    
        return redirect()
            ->route('admin.custom-bundles.index')
            ->with('success', 'Bundle type created successfully.');
    }
    
  

    /**
     * Show the form for editing the specified bundle type
     */
    public function edit(BundleType $customBundle) 
{
    $bundleType = $customBundle; // Add this line
    return view('admin.custom-bundles.edit', compact('bundleType'));
}

    /**
     * Update the specified bundle type
     */
    public function update(Request $request, BundleType $customBundle)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'slug' => [
            'required',
            'string',
            'max:255',
            'regex:/^[a-z0-9-]+$/',
            Rule::unique('bundle_types')->ignore($customBundle->id)
        ],
        'active' => 'boolean',
        'features_text' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'image_url' => 'nullable|url'
    ], [
        'slug.regex' => 'The slug may only contain lowercase letters, numbers, and hyphens.'
    ]);

    // Process features if submitted as strings
    $features = [];
    if ($request->has('features_text')) {
        $featuresText = explode("\n", $request->features_text);
        foreach ($featuresText as $feature) {
            $feature = trim($feature);
            if (!empty($feature)) {
                $features[] = $feature;
            }
        }
    }

    // Handle image upload or URL
    $imagePath = $customBundle->image; // Keep existing image by default

    
    if ($request->hasFile('image')) {
        // Delete old image if it's a local file
        if (Str::startsWith($imagePath, 'storage/custom_bundle_images/')) {
            @unlink(public_path($imagePath));
        }
        
        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('storage/custom_bundle_images'), $filename);
        $imagePath = 'storage/custom_bundle_images/' . $filename;
    } elseif ($request->filled('image_url')) {
        $imagePath = $request->image_url;
    }
    $customBundle->update([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'slug' => $request->slug,
        'active' => $request->has('active'),
        'features' => $features,
        'image' => $imagePath
    ]);

    return redirect()
        ->route('admin.custom-bundles.index')
        ->with('success', 'Bundle type updated successfully.');
}

    /**
     * Remove the specified bundle type
     */
    public function destroy($id)
    {
        $bundleType = BundleType::findOrFail($id);
        $bundleType->delete();
        
        return redirect()
            ->route('admin.custom-bundles.index')
            ->with('success', 'Bundle type deleted successfully.');
    }

    /**
     * Manage destinations for custom bundles
     */
    public function manageDestinations()
    {
        $destinations = Destination::orderBy('name')->get();
        
        return view('admin.custom-bundles.destinations', compact('destinations'));
    }

    /**
     * Update destinations for custom bundles
     */
    public function updateDestinations(Request $request)
    {
        $request->validate([
            'destinations' => 'required|array',
            'destinations.*.id' => 'required|exists:destinations,id',
            'destinations.*.display_in_custom_bundles' => 'boolean',
            'destinations.*.destination_type' => 'required|in:domestic,international'
        ]);

        foreach ($request->destinations as $destinationData) {
            $destination = Destination::findOrFail($destinationData['id']);
            $destination->update([
                'display_in_custom_bundles' => isset($destinationData['display_in_custom_bundles']),
                'destination_type' => $destinationData['destination_type']
            ]);
        }

        return redirect()
            ->route('admin.custom-bundles.manage-destinations')
            ->with('success', 'Destination settings updated successfully.');
    }

    /**
     * Generate a slug for a bundle type name
     */
    public function generateSlug(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $slug = Str::slug($request->name);
        
        // Check if slug exists and append a number if needed
        $count = 1;
        $originalSlug = $slug;
        
        while (BundleType::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        
        return response()->json(['slug' => $slug]);
    }
}