<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $bookings = UserBooking::where('user_id', $user->id)
                            ->with('bundle')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
        
        return view('user.dashboard', compact('user', 'bookings'));
    }

    public function profile()
    {
        $user = Auth::user();
        
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->bio = $request->bio;

        if ($request->hasFile('profile_image')) {
            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('storage/profile_images'), $imageName);
            $user->profile_image = 'storage/profile_images/' . $imageName;
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully');
    }
}