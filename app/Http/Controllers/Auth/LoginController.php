<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin\CaptchaSetting;
use App\Rules\Turnstile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }    public function login(Request $request)
    {
        // Get captcha settings
        $captchaSettings = CaptchaSetting::first();
        
        // Define validation rules
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
        
        // Add Turnstile validation if enabled and captcha settings exist
        if ($captchaSettings && $captchaSettings->enabled && $captchaSettings->enable_on_login) {
            $rules['cf-turnstile-response'] = ['required', new Turnstile()];
        }
        
        // Validate the request
        $validatedData = $request->validate($rules, [
            'cf-turnstile-response.required' => 'Please complete the CAPTCHA verification.'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->is_admin) {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(route('user.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
