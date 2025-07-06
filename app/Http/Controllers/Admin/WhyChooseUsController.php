<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\WhyChooseUs;
use Illuminate\Http\Request;

class WhyChooseUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = WhyChooseUs::orderBy('sort_order')->get();
        return view('admin.why-choose-us.index', compact('features'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.why-choose-us.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:255',
            'color' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'active' => 'boolean',
        ]);
        
        // Set active to false if not provided
        $validated['active'] = $request->has('active');
        
        WhyChooseUs::create($validated);
        
        return redirect()->route('admin.why-choose-us.index')
            ->with('success', 'Feature created successfully.');
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WhyChooseUs $whyChooseUs)
    {
        return view('admin.why-choose-us.edit', compact('whyChooseUs'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WhyChooseUs $whyChooseUs)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:255',
            'color' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);
        
        // Set active to false if not provided
        $validated['active'] = $request->has('active');
        
        $whyChooseUs->update($validated);
        
        return redirect()->route('admin.why-choose-us.index')
            ->with('success', 'Feature updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WhyChooseUs $whyChooseUs)
    {
        $whyChooseUs->delete();
        
        return redirect()->route('admin.why-choose-us.index')
            ->with('success', 'Feature deleted successfully.');
    }
    
    /**
     * Update the order of features
     */
    public function updateOrder(Request $request)
    {
        $features = $request->input('features', []);
        
        foreach ($features as $feature) {
            $whyChooseUs = WhyChooseUs::find($feature['id']);
            if ($whyChooseUs) {
                $whyChooseUs->update(['sort_order' => $feature['order']]);
            }
        }
        
        return response()->json(['success' => true]);
    }
}