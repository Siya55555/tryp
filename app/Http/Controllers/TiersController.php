<?php

namespace App\Http\Controllers;

use App\Models\Admin\TravelPackage;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Faq;
use App\Services\PaymentService;

class TiersController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Display the packages index.
     */
    public function index()
    {
        // Get active travel packages ordered by sort_order
        $travelPackages = TravelPackage::where('status', 'active')
            ->orderBy('sort_order')
            ->get();
        
        $faqCategories = Faq::active()
            ->ordered()
            ->get()
            ->groupBy('category');
        // Pass the $travelPackages variable to the view
        return view('tiers.index', compact('travelPackages','faqCategories'));
    }

    /**
     * Display the specified package.
     */
    public function show($type)
    {
        // Find the package by type
        $package = TravelPackage::where('type', $type)
            ->where('status', 'active')
            ->firstOrFail();
            
        $packageType = $type;
        $packageName = $package->name;
        $packageDescription = $package->short_description ?? 'Premium vacation package';
        $packagePrice = $package->price;
        
        return view('tiers.show', compact(
            'packageType',
            'packageName',
            'packageDescription',
            'packagePrice',
            'package'
        ));
    }

    /**
     * Process the booking form.
     */
    public function book(Request $request)
    {
        // Validate booking data (remove card fields, add stripeToken)
        $validated = $request->validate([
            'package_type' => 'required|string',
            'package_price' => 'required|numeric',
            'quantity' => 'required|integer|min:1|max:4',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:2',
            'zip' => 'required|string|max:10',
            'consent' => 'required',
            'stripeToken' => 'required|string',
        ]);
        
        // Find the package by type
        $package = TravelPackage::where('type', $validated['package_type'])->firstOrFail();
        $quantity = $validated['quantity'];
        $totalAmount = $validated['package_price'] * $quantity;

        $customerInfo = [
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'zip' => $validated['zip'],
        ];

        // Process payment using Stripe token
        \Log::info('Attempting to process payment for membership', ['stripeToken' => $validated['stripeToken'], 'totalAmount' => $totalAmount, 'customerInfo' => $customerInfo]);
        try {
            $result = $this->paymentService->processCardPayment(
                $validated['stripeToken'],
                $totalAmount,
                'USD',
                $customerInfo,
                'Membership package purchase (' . $package->name . ')',
                'stripe' // or null for default
            );
            \Log::info('Stripe payment result', ['result' => $result]);
            if (empty($result['success']) || !$result['success']) {
                \Log::error('Stripe payment failed', ['result' => $result]);
                return back()->withErrors(['payment' => $result['message'] ?? 'Payment failed. Your card was not charged.'])->withInput();
            }
        } catch (\Exception $e) {
            \Log::error('Stripe payment exception', ['error' => $e->getMessage()]);
            return back()->withErrors(['payment' => $e->getMessage()])->withInput();
        }

        // Create a new booking in the database
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'package_type' => $validated['package_type'],
            'package_name' => $package->name,
            'package_price' => $validated['package_price'],
            'quantity' => $quantity,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'zip' => $validated['zip'],
            'payment_method' => 'credit_card',
            'card_last_four' => null, // Not available with tokenization
            'status' => 'paid',
        ]);

        // For the thank you page, we prepare a booking array
        $bookingData = [
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'package' => $package->name,
            'price' => $totalAmount,
            'quantity' => $quantity,
            'transaction_id' => $result['transaction_id'] ?? null,
        ];

        return redirect()->route('tiers.thankyou')->with('booking', $bookingData);
    }

    /**
     * Display the thank you page after booking.
     */
    public function thankYou()
    {
        if (!session('booking')) {
            return redirect()->route('tiers.index');
        }

        $booking = session('booking');
        
        return view('tiers.thankyou', compact('booking'));
    }
}