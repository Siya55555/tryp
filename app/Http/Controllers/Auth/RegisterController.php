<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\EmailVerification;
use App\Models\Admin\CaptchaSetting;
use App\Mail\EmailVerificationOTP;
use App\Rules\Turnstile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }    public function register(Request $request)
    {
        // Get captcha settings
        $captchaSettings = CaptchaSetting::first();
        
        // Define validation rules
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
        
        // Add Turnstile validation if enabled
        // if ($captchaSettings->enabled && $captchaSettings->enable_on_register) {
        //     $rules['cf-turnstile-response'] = ['required', new Turnstile()];
        // }
        
        $validator = Validator::make($request->all(), $rules, [
            'cf-turnstile-response.required' => 'Please complete the CAPTCHA verification.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate a 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Save OTP to email_verifications table
        EmailVerification::create([
            'email' => $user->email,
            'token' => $otp,
            'created_at' => Carbon::now()
        ]);

        // Send verification email with OTP
        try {
            Mail::to($user->email)->send(new EmailVerificationOTP($user, $otp));
            
            // Log successful email send
            Log::info('Email verification OTP sent to: ' . $user->email);
            
        } catch (\Exception $e) {
            // Log error but don't disrupt the registration process
            Log::error('Failed to send email verification OTP: ' . $e->getMessage());
            Log::error('Error trace: ' . $e->getTraceAsString());
        }

        auth()->login($user);

        return redirect()->route('verification.notice');
    }
}