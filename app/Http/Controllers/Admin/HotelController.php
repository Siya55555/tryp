<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Destination;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with('destination')->paginate(15);
        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        $destinations = Destination::all();
        return view('admin.hotels.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amenities' => 'nullable|string',
            'photos' => 'nullable',
            'status' => 'required|in:active,inactive',
        ]);
        $validated['amenities'] = $request->filled('amenities') ? json_encode(array_map('trim', explode(',', $validated['amenities']))) : null;
        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                if ($photo->isValid()) {
                    $photoPaths[] = $photo->store('hotels', 'public');
                }
            }
        }
        $validated['photos'] = !empty($photoPaths) ? json_encode($photoPaths) : null;
        Hotel::create($validated);
        return redirect()->route('admin.hotels.index')->with('success', 'Hotel created successfully.');
    }

    public function edit($id)
    {
        $hotel = Hotel::findOrFail($id);
        $destinations = Destination::all();
        return view('admin.hotels.edit', compact('hotel', 'destinations'));
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        $validated = $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amenities' => 'nullable|string',
            'photos' => 'nullable',
            'status' => 'required|in:active,inactive',
        ]);
        $validated['amenities'] = $request->filled('amenities') ? json_encode(array_map('trim', explode(',', $validated['amenities']))) : null;
        $photoPaths = $hotel->photos ? json_decode($hotel->photos, true) : [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                if ($photo->isValid()) {
                    $photoPaths[] = $photo->store('hotels', 'public');
                }
            }
        }
        $validated['photos'] = !empty($photoPaths) ? json_encode($photoPaths) : null;
        $hotel->update($validated);
        return redirect()->route('admin.hotels.index')->with('success', 'Hotel updated successfully.');
    }

    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();
        return redirect()->route('admin.hotels.index')->with('success', 'Hotel deleted successfully.');
    }
} 