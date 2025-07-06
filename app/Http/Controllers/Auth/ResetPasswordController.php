<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    public function showVerifyForm(Request $request)
    {
        return view('auth.passwords.verify_otp', ['email' => $request->email]);
    }
    
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric|digits:6',
        ]);

        // Find the password reset record
        $passwordReset = PasswordReset::where('email', $request->email)
            ->where('token', $request->otp)
            ->first();

        // Check if OTP exists and is valid (not older than 60 minutes)
        if (!$passwordReset || Carbon::parse($passwordReset->created_at)->addMinutes(60)->isPast()) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        // If OTP is valid, store in session that this email is verified
        $request->session()->put('password_reset_email', $request->email);
        $request->session()->put('password_reset_verified', true);
        
        // Redirect to password reset form
        return redirect()->route('password.reset');
    }

    public function showResetForm(Request $request)
    {
        // Check if the email is verified via OTP
        if (!$request->session()->get('password_reset_verified', false)) {
            return redirect()->route('password.request')
                ->with('error', 'Please verify your email with OTP first.');
        }
        
        $email = $request->session()->get('password_reset_email');
        
        return view('auth.passwords.reset', ['email' => $email]);
    }
    
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Check if the email is verified via OTP
        if (!$request->session()->get('password_reset_verified', false) || 
            $request->email !== $request->session()->get('password_reset_email')) {
            return redirect()->route('password.request')
                ->with('error', 'Please verify your email with OTP first.');
        }

        // Update the user's password
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the password reset record
        PasswordReset::where('email', $request->email)->delete();
        
        // Clear session verification
        $request->session()->forget(['password_reset_email', 'password_reset_verified']);

        // Log the user in
        auth()->login($user);

        return redirect()->route('user.dashboard')
            ->with('success', 'Your password has been reset successfully.');
    }
}