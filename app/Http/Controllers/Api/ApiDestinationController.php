<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class ApiDestinationController extends Controller
{
    /**
     * Search for destinations based on query
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $destinations = Destination::where('name', 'like', "%{$query}%")
            ->orWhere('location', 'like', "%{$query}%")
            ->take(5)
            ->get(['id', 'name', 'location', 'main_image']);
        
        return response()->json($destinations);
    }
}