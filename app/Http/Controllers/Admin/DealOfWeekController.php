<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DealOfWeek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DealOfWeekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deals = DealOfWeek::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.deals.index', compact('deals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.deals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'expires_in_days' => 'nullable|integer|min:1',
            'cta_text' => 'nullable|string|max:50',
            'cta_link' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle features array - remove empty values
        $features = collect($request->features)->filter()->values()->toArray();

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('deals', 'public');
        }

        // Calculate expires_at date
        $expiresAt = null;
        if ($request->filled('expires_in_days')) {
            // Ensure expires_in_days is cast to integer
            $expiresInDays = (int) $request->input('expires_in_days');
            $expiresAt = Carbon::now()->addDays($expiresInDays);
        }

        DealOfWeek::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'features' => $features,
            'image' => $imagePath,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'expires_at' => $expiresAt,
            'cta_text' => $request->cta_text ?? 'BOOK NOW',
            'cta_link' => $request->cta_link,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.deals.index')->with('success', 'Deal of the Week created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DealOfWeek $deal)
    {
        return view('admin.deals.edit', compact('deal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DealOfWeek $deal)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'expires_in_days' => 'nullable|integer|min:1',
            'cta_text' => 'nullable|string|max:50',
            'cta_link' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle features array
        $features = collect($request->features)->filter()->values()->toArray();

        // Handle image upload
        $imagePath = $deal->image;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($deal->image) {
                Storage::disk('public')->delete($deal->image);
            }
            $imagePath = $request->file('image')->store('deals', 'public');
        }

        // Calculate expires_at date
        // In your update method:
        $expiresAt = null;
        if ($request->filled('expires_at')) {
            $expiresAt = Carbon::parse($request->input('expires_at'))->setTime(23, 59, 59);
        }

        $deal->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'features' => $features,
            'image' => $imagePath,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'expires_at' => $expiresAt,
            'cta_text' => $request->cta_text ?? 'BOOK NOW',
            'cta_link' => $request->cta_link,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.deals.index')->with('success', 'Deal of the Week updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DealOfWeek $deal)
    {
        // Delete image if exists
        if ($deal->image) {
            Storage::disk('public')->delete($deal->image);
        }

        $deal->delete();
        return redirect()->route('admin.deals.index')->with('success', 'Deal of the Week deleted successfully.');
    }
    
    /**
     * Set this deal as the active one and deactivate others.
     */
    public function setActive(DealOfWeek $deal)
    {
        // Deactivate all other deals
        DealOfWeek::where('id', '!=', $deal->id)
            ->where('status', 'active')
            ->update(['status' => 'inactive']);
            
        // Set this deal as active
        $deal->update(['status' => 'active']);
        
        return redirect()->route('admin.deals.index')->with('success', 'Deal of the Week set as active successfully.');
    }
}