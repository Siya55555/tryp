<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationOTP;
use Carbon\Carbon;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
    
    public function show()
    {
        // Get the authenticated user's email
        $email = auth()->user()->email;
        
        // Pass it to the view
        return view('auth.verify', ['email' => $email]);
    }
    
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric|digits:6',
        ]);

        $verification = EmailVerification::where('email', $request->email)
            ->where('token', $request->otp)
            ->first();

        if (!$verification || Carbon::parse($verification->created_at)->addMinutes(60)->isPast()) {
            return back()->with('error', 'Invalid or expired OTP code.');
        }

        $user = User::where('email', $request->email)->first();
        $user->email_verified_at = Carbon::now();
        $user->save();

        EmailVerification::where('email', $request->email)->delete();

        return redirect()->route('user.dashboard')
            ->with('success', 'Your email has been verified successfully.');
    }
    
    public function resend(Request $request)
    {
        $user = auth()->user();
        
        if ($user->email_verified_at) {
            return redirect()->route('user.dashboard');
        }
        
        // Generate a 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Save OTP to email_verifications table
        EmailVerification::updateOrCreate(
            ['email' => $user->email],
            [
                'token' => $otp,
                'created_at' => Carbon::now()
            ]
        );

        // Send OTP via email
        try {
            Mail::to($user->email)->send(new EmailVerificationOTP($user, $otp));
            
            return back()->with('success', 'Verification link sent!');
        } catch (\Exception $e) {
            return back()->with('error', 'Could not send verification code. Please try again.');
        }
    }
}