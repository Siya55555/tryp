<?php

namespace App\Http\Controllers;

use App\Models\PaymentGateway;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Display the checkout page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function checkout(Request $request)
    {
        // Get the amount from the session or request
        $amount = $request->session()->get('payment_amount', $request->amount);
        $currency = $request->session()->get('payment_currency', $request->currency ?? 'USD');
        
        return view('payment.checkout', compact('amount', 'currency'));
    }

    /**
     * Display the payment success page
     * 
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function success(Request $request)
    {
        $transactionId = $request->tid;
        return view('payment.success', compact('transactionId'));
    }
    
    /**
     * Display the payment cancel page
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function cancel()
    {
        return view('payment.cancel');
    }

    /**
     * Get all active payment gateways
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getActiveGateways()
    {
        $gateways = PaymentGateway::where('is_active', true)
            ->select('id', 'name', 'display_name', 'gateway_type', 'description', 'instructions', 'icon', 'is_default')
            ->get();

        return response()->json([
            'success' => true,
            'gateways' => $gateways
        ]);
    }

    /**
     * Process a credit card payment
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'card_number' => 'required|string',
            'exp_month' => 'required|numeric|min:1|max:12',
            'exp_year' => 'required|numeric|min:' . date('Y'),
            'cvc' => 'required|string|min:3|max:4',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string|size:3',
            'name' => 'required|string',
            'email' => 'required|email',
            'gateway_type' => 'nullable|string',
        ]);

        $cardData = [
            'card_number' => $request->card_number,
            'exp_month' => $request->exp_month,
            'exp_year' => $request->exp_year,
            'cvc' => $request->cvc,
        ];

        $customerInfo = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address ?? null,
            'city' => $request->city ?? null,
            'state' => $request->state ?? null,
            'zip' => $request->zip ?? null,
            'country' => $request->country ?? null,
        ];

        try {
            // Validate the card data
            if (!$this->paymentService->validateCardData($cardData)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credit card information',
                ], 422);
            }

            // Process the payment
            $result = $this->paymentService->processCardPayment(
                $cardData,
                $request->amount,
                $request->currency,
                $customerInfo,
                'Booking payment for ' . $request->name,
                $request->gateway_type
            );

            return response()->json([
                'success' => true,
                'transaction' => $result,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
