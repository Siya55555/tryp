<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetOTP;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'No user found with this email address.'
        ]);

        $user = User::where('email', $request->email)->first();
        
        // Generate a 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Use DB facade instead of model for better control
        DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => $otp,
                'created_at' => Carbon::now()
            ]
        );

        // Send OTP via email
        try {
            Mail::to($user->email)->send(new PasswordResetOTP($user, $otp));
            
            return redirect()->route('password.verify', ['email' => $user->email])
                ->with('success', 'We have sent an OTP to your email address.');
                
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Could not send reset code. Please try again.']);
        }
    }
}