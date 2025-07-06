<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;  // Use the main User model instead of Admin\User
use App\Models\Admin\Bundle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = User::query();
        
        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        // Filter by role
        if ($request->has('role') && $request->role != '') {
            if ($request->role == 'admin') {
                $query->where('is_admin', true);
            } else {
                $query->where('is_admin', false);
            }
        }
        
        $users = $query->latest()->paginate(10);
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response|RedirectResponse
     */
    public function store(Request $request): Response|RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
        ]);
        
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'bio' => $request->bio,
            'is_admin' => $request->has('is_admin'),
        ];
        
        // Handle email verification
        if ($request->has('email_verified')) {
            $userData['email_verified_at'] = now();
        }
        
        // Handle profile image
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $userData['profile_image'] = 'storage/' . $path;
        }
        
        User::create($userData);
        
        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\Models\User  $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return Response|RedirectResponse
     */
    public function update(Request $request, User $user): Response|RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
        ]);
        
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio,
            'is_admin' => $request->has('is_admin'),
        ];
        
        // Update password if provided
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }
        
        // Handle email verification
        if ($request->has('email_verified') && !$user->email_verified_at) {
            $userData['email_verified_at'] = now();
        }
        
        // Handle profile image
        if ($request->hasFile('profile_image')) {
            // Delete the old image if it exists
            if ($user->profile_image) {
                // Check if the old image is in the storage folder
                if (strpos($user->profile_image, 'storage/') === 0) {
                    // Remove the 'storage/' prefix when deleting
                    Storage::disk('public')->delete(str_replace('storage/', '', $user->profile_image));
                } 
                // Check if it's in the public folder (for backward compatibility)
                else if (file_exists(public_path($user->profile_image))) {
                    unlink(public_path($user->profile_image));
                }
            }
            
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $userData['profile_image'] = 'storage/' . $path;
        }
        
        $user->update($userData);
        
        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\Models\User  $user
     * @return Response|RedirectResponse
     */
    public function destroy(User $user): Response|RedirectResponse
    {
        // Prevent deleting self
        if ($user->id === auth()->id()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        // Check if user has bookings
        if ($user->hasBookings()) {
            $bookingCounts = $user->getBookingCounts();
            $message = 'Cannot delete user. This user has ';
            $messages = [];
            
            if ($bookingCounts['bundle_bookings'] > 0) {
                $messages[] = $bookingCounts['bundle_bookings'] . ' bundle booking(s)';
            }
            
            if ($bookingCounts['tier_bookings'] > 0) {
                $messages[] = $bookingCounts['tier_bookings'] . ' package booking(s)';
            }
            
            $message .= implode(' and ', $messages) . '. Please delete the bookings first before deleting the user.';
            
            return redirect()
                ->back()
                ->with('error', $message);
        }
        
        // Remove profile image if it exists
        if ($user->profile_image) {
            if (strpos($user->profile_image, 'storage/') === 0) {
                Storage::disk('public')->delete(str_replace('storage/', '', $user->profile_image));
            } else if (file_exists(public_path($user->profile_image))) {
                unlink(public_path($user->profile_image));
            }
        }
        
        $user->delete();
          return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Check if user has bookings for AJAX requests.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkBookings(User $user)
    {
        $bookingCounts = $user->getBookingCounts();
        
        return response()->json([
            'has_bookings' => $user->hasBookings(),
            'bundle_bookings' => $bookingCounts['bundle_bookings'],
            'tier_bookings' => $bookingCounts['tier_bookings'],
            'total_bookings' => $bookingCounts['total']
        ]);
    }
    
    /**
     * Display the user's bookings.
     *
     * @param  \App\Models\User  $user
     * @return View
     */
    public function bookings(User $user): View
    {
        $bookings = $user->bookings()->with('bundle')->latest()->paginate(10);
        return view('admin.users.bookings', compact('user', 'bookings'));
    }
    
    /**
     * Send verification email to the user.
     *
     * @param  \App\Models\User  $user
     * @return Response|RedirectResponse
     */
    public function sendVerification(User $user): Response|RedirectResponse
    {
        if ($user->email_verified_at) {
            return redirect()
                ->back()
                ->with('error', 'User is already verified.');
        }
        
        // Generate a 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Save OTP to email_verifications table
        \App\Models\EmailVerification::updateOrCreate(
            ['email' => $user->email],
            [
                'token' => $otp,
                'created_at' => now()
            ]
        );

        // Send OTP via email
        try {
            $verifyUrl = route('verification.verify', ['email' => $user->email]);

            // Then update the mailable creation
            \Illuminate\Support\Facades\Mail::to($user->email)
                ->send(new \App\Mail\ResendEmailVerificationOTP($user, $otp, $verifyUrl));
            
            return redirect()
                ->back()
                ->with('success', 'Verification email sent successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Could not send verification email. Please try again.');
        }
    }
    public function impersonate(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot impersonate yourself.');
        }

        // Store current admin's ID in session
        session()->put('impersonator_id', auth()->id());
        
        // Login as the target user
        auth()->login($user);

        return redirect()->route('user.dashboard')
            ->with('success', "You are now impersonating {$user->name}");
    }
}