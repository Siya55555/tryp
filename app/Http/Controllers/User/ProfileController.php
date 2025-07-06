<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile page.
     */
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }
    
    /**
     * Update the user's profile information.
     */
    public function updateProfile(Request $request)
    {
        // Modify validation to not require email since it's disabled in the form
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $user = Auth::user();
        $user->name = $request->name;
        // Don't update email as it's disabled in the form
        $user->bio = $request->bio;
        
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
            
            // Store the new image in storage/app/public/profile_images
            $path = $request->file('profile_image')->store('profile_images', 'public');
            
            // Save the path with 'storage/' prefix for web access
            $user->profile_image = 'storage/' . $path;
        }
        
        $user->save();
        
        return redirect()->route('user.profile')->with('success', 'Profile updated successfully');
    }
    
    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $user = Auth::user();
        
        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }
        
        $user->password = Hash::make($request->password);
        $user->save();
        
        return redirect()->route('user.profile')->with('success', 'Password changed successfully');
    }
}