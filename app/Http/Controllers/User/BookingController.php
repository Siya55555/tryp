<?php

namespace App\Http\Controllers\User;
use PDF;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\UserBooking;
use App\Models\Bundle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the user's bookings
     */
    public function index()
    {
        $bookings = UserBooking::where('user_id', Auth::id())
                           ->with('bundle')
                           ->orderBy('created_at', 'desc')
                           ->paginate(10);
        
        return view('user.bookings.index', compact('bookings'));
    }
    
    /**
     * Display the specified booking details
     */
    public function show(UserBooking $booking)
    {
        // Make sure the booking belongs to the authenticated user
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('user.bookings.show', compact('booking'));
    }
    
    /**
     * Show the form for creating a new booking
     */
    public function create()
    {
        $bundles = Bundle::where('status', 'active')->get();
        return view('user.bookings.create', compact('bundles'));
    }
    
    /**
     * Store a newly created booking in storage
     */
    public function store(Request $request)
    {
        $request->validate([
            'bundle_id' => 'required|exists:bundles,id',
            'booking_date' => 'required|date|after:today',
            'notes' => 'nullable|string|max:500',
            'number_of_people' => 'required|integer|min:1|max:20',
        ]);
        
        // Create booking with manually set ID
        UserBooking::create([
            'id' => UserBooking::max('id') + 1, // Simple approach
            'user_id' => Auth::id(),
            'bundle_id' => $request->bundle_id,
            'booking_date' => $request->booking_date,
            'status' => 'pending',
            'notes' => $request->notes,
            'number_of_people' => $request->number_of_people,
        ]);
        
        return redirect()->route('user.bookings.index')
                        ->with('success', 'Booking request submitted successfully');
    }
    
    /**
     * Cancel a booking
     */
    public function cancel(UserBooking $booking)
    {
        // Make sure the booking belongs to the authenticated user
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Only pending bookings can be cancelled
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Only pending bookings can be cancelled');
        }
        
        $booking->update(['status' => 'cancelled']);
        
        return redirect()->route('user.bookings.index')
                        ->with('success', 'Booking cancelled successfully');
    }
    
    
    
    public function download(UserBooking $booking)
    {
        // Make sure the booking belongs to the authenticated user
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $pdf = PDF::loadView('user.pdf', compact('booking'));
        
        return $pdf->download('booking-'.$booking->id.'.pdf');
    }
    
}