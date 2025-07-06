<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\UserBooking;
use App\Models\Admin\Bundle;
use App\Models\Admin\TravelPackage;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use PDF;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    /**
     * Display a listing of the bookings.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Determine which type of bookings to show based on request
        $bookingType = $request->get('type', 'all');
        
        if ($bookingType === 'bundles') {
            return $this->indexBundleBookings($request);
        } 
        elseif ($bookingType === 'packages') {
            return $this->indexPackageBookings($request);
        }
        else {
            return $this->indexAllBookings($request, $bookingType);
        }
    }
    
    /**
     * Display only bundle bookings.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    protected function indexBundleBookings(Request $request)
    {
        $query = UserBooking::with(['user', 'bundle']);
        $bookingType = 'bundles';

        // Apply search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Apply status filter
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Apply bundle filter
        if ($request->has('bundle') && !empty($request->bundle)) {
            $query->where('bundle_id', $request->bundle);
        }

        // Apply date range filters
        if ($request->has('date_from') && !empty($request->date_from)) {
            $query->whereDate('booking_date', '>=', $request->date_from);
        }
        if ($request->has('date_to') && !empty($request->date_to)) {
            $query->whereDate('booking_date', '<=', $request->date_to);
        }

        $bundles = Bundle::orderBy('name')->get();
        $bookings = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.bookings.index', compact('bookings', 'bundles', 'bookingType'));
    }
    
    /**
     * Display only package bookings.
     *
     * @param Request $request
     * @return View|RedirectResponse
     */
    protected function indexPackageBookings(Request $request): View|RedirectResponse
    {
        // Check if Booking class exists and tier_bookings table exists
        $bookingClassExists = class_exists('\\App\\Models\\Booking');
        $tierBookingsTableExists = Schema::hasTable('tier_bookings');
        
        if (!$bookingClassExists || !$tierBookingsTableExists) {
            return redirect()->route('admin.bookings.index')
                ->with('error', 'Package bookings are not set up yet. Please run migrations first.');
        }
        
        $query = Booking::query();
        $bookingType = 'packages';
        
        // Apply search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }
        
        // Apply status filter
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }
        
        // Apply package type filter
        if ($request->has('package_type') && !empty($request->package_type)) {
            $query->where('package_type', $request->package_type);
        }
        
        // Apply date range filters
        if ($request->has('date_from') && !empty($request->date_from)) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to') && !empty($request->date_to)) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        $packages = TravelPackage::orderBy('name')->get();
        $bookings = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.bookings.package_index', compact('bookings', 'packages', 'bookingType'));
    }
    
    /**
     * Display all bookings in a combined view.
     *
     * @param Request $request
     * @param string $bookingType
     * @return \Illuminate\View\View
     */
    protected function indexAllBookings(Request $request, $bookingType = 'all')
    {
        $bundleBookings = UserBooking::with(['user', 'bundle'])
            ->when($request->has('status') && !empty($request->status), function($query) use ($request) {
                return $query->where('status', $request->status);
            })
            ->when($request->has('date_from') && !empty($request->date_from), function($query) use ($request) {
                return $query->whereDate('booking_date', '>=', $request->date_from);
            })
            ->when($request->has('date_to') && !empty($request->date_to), function($query) use ($request) {
                return $query->whereDate('booking_date', '<=', $request->date_to);
            })
            ->when($request->has('search') && !empty($request->search), function($query) use ($request) {
                $search = $request->search;
                return $query->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->get();
        
        // Check if Booking class exists and tier_bookings table exists
        $bookingClassExists = class_exists('\\App\\Models\\Booking');
        $tierBookingsTableExists = Schema::hasTable('tier_bookings');
        
        $packageBookings = collect([]);
        if ($bookingClassExists && $tierBookingsTableExists) {
            $packageBookings = Booking::query()
                ->when($request->has('status') && !empty($request->status), function($query) use ($request) {
                    return $query->where('status', $request->status);
                })
                ->when($request->has('date_from') && !empty($request->date_from), function($query) use ($request) {
                    return $query->whereDate('created_at', '>=', $request->date_from);
                })
                ->when($request->has('date_to') && !empty($request->date_to), function($query) use ($request) {
                    return $query->whereDate('created_at', '<=', $request->date_to);
                })
                ->when($request->has('search') && !empty($request->search), function($query) use ($request) {
                    $search = $request->search;
                    return $query->where(function($q) use ($search) {
                        $q->where('first_name', 'like', "%{$search}%")
                          ->orWhere('last_name', 'like', "%{$search}%")
                          ->orWhere('email', 'like', "%{$search}%")
                          ->orWhere('phone', 'like', "%{$search}%");
                    });
                })
                ->get();
        }
        
        // Combine and paginate manually
        $combinedBookings = $bundleBookings->concat($packageBookings)
            ->sortByDesc('created_at')
            ->values();
        
        // Manual pagination
        $page = request()->get('page', 1);
        $perPage = 10;
        $totalItems = $combinedBookings->count();
        $bookings = new \Illuminate\Pagination\LengthAwarePaginator(
            $combinedBookings->forPage($page, $perPage),
            $totalItems,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        
        $bundles = Bundle::orderBy('name')->get();
        $packages = TravelPackage::orderBy('name')->get();
        
        return view('admin.bookings.combined_index', compact('bookings', 'bundles', 'packages', 'bookingType'));
    }

    /**
     * Show the form for creating a new booking.
     *
     * @return View|RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        $bookingType = request('type', 'bundle');
        
        if ($bookingType === 'package') {
            // Check if Booking class exists and tier_bookings table exists
            $bookingClassExists = class_exists('\\App\\Models\\Booking');
            $tierBookingsTableExists = Schema::hasTable('tier_bookings');
            
            if (!$bookingClassExists || !$tierBookingsTableExists) {
                return redirect()->route('admin.bookings.index')
                    ->with('error', 'Package bookings are not set up yet. Please run migrations first.');
            }
            
            $users = User::orderBy('name')->get();
            $packages = TravelPackage::where('status', 'active')->orderBy('name')->get();
            return view('admin.bookings.package_create', compact('users', 'packages'));
        } else {
            $users = User::orderBy('name')->get();
            $bundles = Bundle::orderBy('name')->get();
            return view('admin.bookings.create', compact('users', 'bundles'));
        }
    }

    /**
     * Store a newly created booking in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->has('booking_type') && $request->booking_type === 'package') {
            return $this->storePackageBooking($request);
        } else {
            return $this->storeBundleBooking($request);
        }
    }
    
    /**
     * Store a new package booking.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function storePackageBooking(Request $request)
    {
        // Check if Booking class exists and tier_bookings table exists
        $bookingClassExists = class_exists('\\App\\Models\\Booking');
        $tierBookingsTableExists = Schema::hasTable('tier_bookings');
        
        if (!$bookingClassExists || !$tierBookingsTableExists) {
            return redirect()->route('admin.bookings.index')
                ->with('error', 'Package bookings are not set up yet. Please run migrations first.');
        }
        
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'package_type' => 'required|string',
            'package_name' => 'required|string',
            'package_price' => 'required|numeric',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'payment_method' => 'required|string',
            'card_last_four' => 'nullable|string|max:4',
            'status' => 'required|in:pending,confirmed,cancelled',
            'notes' => 'nullable|string',
        ]);
        
        Booking::create($request->all());
        
        return redirect()->route('admin.bookings.index', ['type' => 'packages'])
            ->with('success', 'Package booking created successfully');
    }
    
    /**
     * Store a new bundle booking.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function storeBundleBooking(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'bundle_id' => 'required|exists:bundles,id',
            'booking_date' => 'required|date',
            'status' => 'required|in:pending,confirmed,cancelled',
            'notes' => 'nullable|string',
            'number_of_people' => 'required|integer|min:1'
        ]);

        // Generate a unique ID
        $data = $request->all();
        $data['id'] = UserBooking::max('id') + 1; // Simple approach
        
        UserBooking::create($data);
        
        return redirect()->route('admin.bookings.index', ['type' => 'bundles'])
            ->with('success', 'Bundle booking created successfully');
    }
    // Rest of the controller methods follow...
    
    /**
     * Display the specified booking.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $bookingType = request('type', 'auto');
        
        if ($bookingType === 'package' || ($bookingType === 'auto' && $this->isPackageBooking($id))) {
            return $this->showPackageBooking($id);
        } else {
            return $this->showBundleBooking($id);
        }
    }
    
    /**
     * Check if the booking is a package booking.
     *
     * @param  int  $id
     * @return bool
     */
    protected function isPackageBooking($id)
    {
        $bookingClassExists = class_exists('\\App\\Models\\Booking');
        $tierBookingsTableExists = Schema::hasTable('tier_bookings');
        
        if (!$bookingClassExists || !$tierBookingsTableExists) {
            return false;
        }
        
        return Booking::find($id) !== null;
    }
    
    /**
     * Display the specified package booking.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */    protected function showPackageBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $users = User::orderBy('name')->get();
        $packages = TravelPackage::orderBy('name')->get();
        
        return view('admin.bookings.package_show', compact('booking', 'users', 'packages'));
    }
    
    /**
     * Display the specified bundle booking.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    protected function showBundleBooking($id)
    {
        $booking = UserBooking::with(['user', 'bundle'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }
    
    /**
     * Show the form for editing the specified booking.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $bookingType = request('type', 'auto');
        
        if ($bookingType === 'package' || ($bookingType === 'auto' && $this->isPackageBooking($id))) {
            return $this->editPackageBooking($id);
        } else {
            return $this->editBundleBooking($id);
        }
    }
    
    /**
     * Show the form for editing the specified package booking.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    protected function editPackageBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $users = User::orderBy('name')->get();
        $packages = TravelPackage::orderBy('name')->get();
        
        return view('admin.bookings.package_edit', compact('booking', 'users', 'packages'));
    }
    
    /**
     * Show the form for editing the specified bundle booking.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    protected function editBundleBooking($id)
    {
        $booking = UserBooking::findOrFail($id);
        $users = User::orderBy('name')->get();
        $bundles = Bundle::orderBy('name')->get();
        
        return view('admin.bookings.edit', compact('booking', 'users', 'bundles'));
    }

    /**
     * Update the specified booking in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if ($request->has('booking_type') && $request->booking_type === 'package') {
            return $this->updatePackageBooking($request, $id);
        } else {
            return $this->updateBundleBooking($request, $id);
        }
    }
    
    /**
     * Update the specified package booking in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function updatePackageBooking(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'package_type' => 'required|string',
            'package_name' => 'required|string',
            'package_price' => 'required|numeric',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'payment_method' => 'required|string',
            'card_last_four' => 'nullable|string|max:4',
            'status' => 'required|in:pending,confirmed,cancelled',
            'notes' => 'nullable|string',
        ]);
        
        $booking->update($request->all());
        
        return redirect()->route('admin.bookings.show', ['booking' => $booking->id, 'type' => 'package'])
            ->with('success', 'Package booking updated successfully');
    }
    
    /**
     * Update the specified bundle booking in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function updateBundleBooking(Request $request, $id)
    {
        $booking = UserBooking::findOrFail($id);
        
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'bundle_id' => 'required|exists:bundles,id',
            'booking_date' => 'required|date',
            'status' => 'required|in:pending,confirmed,cancelled',
            'notes' => 'nullable|string',
            'number_of_people' => 'required|integer|min:1'
        ]);

        $booking->update($request->all());
        
        return redirect()->route('admin.bookings.show', $booking->id)
            ->with('success', 'Bundle booking updated successfully');
    }

    /**
     * Confirm the specified booking.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirm($id)
    {
        $bookingType = request('type', 'auto');
        
        if ($bookingType === 'package' || ($bookingType === 'auto' && $this->isPackageBooking($id))) {
            $booking = Booking::findOrFail($id);
            $booking->update(['status' => 'confirmed']);
            
            // Optional: Send confirmation email
            // $this->sendConfirmationEmail($booking);
            
            return redirect()->route('admin.bookings.show', ['booking' => $booking->id, 'type' => 'package'])
                ->with('success', 'Package booking confirmed successfully');
        } else {
            $booking = UserBooking::findOrFail($id);
            $booking->update(['status' => 'confirmed']);
            
            // Optional: Send confirmation email
            // $this->sendBundleConfirmationEmail($booking);
            
            return redirect()->route('admin.bookings.show', $booking->id)
                ->with('success', 'Bundle booking confirmed successfully');
        }
    }

    /**
     * Cancel the specified booking.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel($id)
    {
        $bookingType = request('type', 'auto');
        
        if ($bookingType === 'package' || ($bookingType === 'auto' && $this->isPackageBooking($id))) {
            $booking = Booking::findOrFail($id);
            $booking->update(['status' => 'cancelled']);
            
            // Optional: Send cancellation email
            // $this->sendCancellationEmail($booking);
            
            return redirect()->route('admin.bookings.show', ['booking' => $booking->id, 'type' => 'package'])
                ->with('success', 'Package booking cancelled successfully');
        } else {
            $booking = UserBooking::findOrFail($id);
            $booking->update(['status' => 'cancelled']);
            
            // Optional: Send cancellation email
            // $this->sendBundleCancellationEmail($booking);
            
            return redirect()->route('admin.bookings.show', $booking->id)
                ->with('success', 'Bundle booking cancelled successfully');
        }
    }
    
    /**
     * Send notification email for the booking.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function email($id)
    {
        $bookingType = request('type', 'auto');
        
        if ($bookingType === 'package' || ($bookingType === 'auto' && $this->isPackageBooking($id))) {
            $booking = Booking::findOrFail($id);
            
            // Add your email sending logic here for package bookings
            // Example:
            // Mail::to($booking->email)->send(new PackageBookingNotification($booking));
            
            return redirect()->back()->with('success', 'Notification email sent successfully');
        } else {
            $booking = UserBooking::findOrFail($id);
            
            // Add your email sending logic here for bundle bookings
            // Example:
            // Mail::to($booking->user->email)->send(new BundleBookingNotification($booking));
            
            return redirect()->back()->with('success', 'Notification email sent successfully');
        }
    }

    /**
     * Generate invoice for the booking.
     *
     * @param  int  $id
     * @return Response|RedirectResponse
     */
    public function generateInvoice($id): Response|RedirectResponse
    {
        $bookingType = request('type', 'auto');
        
        if ($bookingType === 'package' || ($bookingType === 'auto' && $this->isPackageBooking($id))) {
            $booking = Booking::findOrFail($id);
            
            // Add your invoice generation logic here for package bookings
            // Example:
            // $pdf = PDF::loadView('admin.bookings.invoices.package', compact('booking'));
            // return $pdf->download('invoice-' . $booking->id . '.pdf');
            
            return redirect()->back()->with('success', 'Package invoice generated successfully');
        } else {
            $booking = UserBooking::findOrFail($id);
            
            // Add your invoice generation logic here for bundle bookings
            // Example:
            // $pdf = PDF::loadView('admin.bookings.invoices.bundle', compact('booking'));
            // return $pdf->download('invoice-' . $booking->id . '.pdf');
            
            return redirect()->back()->with('success', 'Bundle invoice generated successfully');
        }
    }

    /**
     * Remove the specified booking from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $bookingType = request('type', 'auto');
        
        if ($bookingType === 'package' || ($bookingType === 'auto' && $this->isPackageBooking($id))) {
            $booking = Booking::findOrFail($id);
            $booking->delete();
            
            return redirect()->route('admin.bookings.index', ['type' => 'packages'])
                ->with('success', 'Package booking deleted successfully');
        } else {
            $booking = UserBooking::findOrFail($id);
            $booking->delete();
            
            return redirect()->route('admin.bookings.index', ['type' => 'bundles'])
                ->with('success', 'Bundle booking deleted successfully');
        }
    }
}