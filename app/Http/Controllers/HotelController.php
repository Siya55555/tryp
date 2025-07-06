<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Destination;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index($destinationId)
    {
        $destination = Destination::findOrFail($destinationId);
        $hotels = Hotel::where('destination_id', $destinationId)->where('status', 'active')->get();
        return view('hotels.index', compact('destination', 'hotels'));
    }

    public function show($id)
    {
        $hotel = Hotel::with('destination')->findOrFail($id);
        return view('hotels.show', compact('hotel'));
    }
} 