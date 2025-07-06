<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\TravelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TravelPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = TravelPackage::orderBy('sort_order')->paginate(10);
        return view('admin.travel-packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.travel-packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'features' => 'nullable|array',
            'features.*' => 'string',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
        ]);

        // Generate slug
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;
        
        // Ensure slug is unique
        while (TravelPackage::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('travel-packages', 'public');
            $validated['image'] = $imagePath;
        }

        // Create travel package
        $validated['slug'] = $slug;
        TravelPackage::create($validated);

        return redirect()->route('admin.travel-packages.index')
            ->with('success', 'Travel package created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TravelPackage $travelPackage)
    {
        return view('admin.travel-packages.edit', compact('travelPackage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TravelPackage $travelPackage)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'features' => 'nullable|array',
            'features.*' => 'string',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($travelPackage->image) {
                Storage::disk('public')->delete($travelPackage->image);
            }
            
            $imagePath = $request->file('image')->store('travel-packages', 'public');
            $validated['image'] = $imagePath;
        }

        // Update travel package
        $travelPackage->update($validated);

        return redirect()->route('admin.travel-packages.index')
            ->with('success', 'Travel package updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TravelPackage $travelPackage)
    {
        // Delete image if exists
        if ($travelPackage->image) {
            Storage::disk('public')->delete($travelPackage->image);
        }
        
        $travelPackage->delete();

        return redirect()->route('admin.travel-packages.index')
            ->with('success', 'Travel package deleted successfully');
    }

    /**
     * Update the sort order of travel packages.
     */
    public function updateOrder(Request $request)
    {
        $packages = $request->input('packages', []);
        
        foreach ($packages as $package) {
            TravelPackage::find($package['id'])->update(['sort_order' => $package['position']]);
        }
        
        return response()->json(['success' => true]);
    }
}