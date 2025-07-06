<?php

namespace App\Http\Controllers;

use App\Models\EmailSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmailSubscriptionController extends Controller
{
    /**
     * Subscribe to newsletter
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        try {
            $subscription = EmailSubscription::subscribe($request->email);
            
            return response()->json([
                'success' => true,
                'message' => 'Successfully subscribed to newsletter!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to subscribe. Please try again.'
            ], 500);
        }
    }

    /**
     * Unsubscribe from newsletter
     */
    public function unsubscribe(Request $request, $token)
    {
        // In a production app, you'd want to use a proper token system
        // For now, we'll decode the email from the token
        $email = base64_decode($token);
        
        $subscription = EmailSubscription::where('email', $email)->first();
        
        if ($subscription) {
            $subscription->unsubscribe();
            return view('emails.unsubscribed', ['email' => $email]);
        }
        
        return view('emails.unsubscribe-error');
    }

    /**
     * Show unsubscribe form
     */
    public function showUnsubscribeForm($token = null)
    {
        $email = null;
        if ($token) {
            $email = base64_decode($token);
        }
        
        return view('emails.unsubscribe-form', ['email' => $email, 'token' => $token]);
    }
}
