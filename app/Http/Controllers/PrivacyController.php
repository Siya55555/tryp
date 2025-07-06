<?php

namespace App\Http\Controllers;

use App\Models\Admin\Privacy;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    /**
     * Display the privacy policy page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the active privacy policy or the default one if no active policy exists
        $privacy = Privacy::active()->latest()->first();
        
        if (!$privacy) {
            $privacy = Privacy::where('is_default', true)->first();
        }
        
        // If still no privacy policy found, create a simple placeholder
        if (!$privacy) {
            $privacy = new Privacy([
                'title' => 'Privacy Policy',
                'content' => 'Our privacy policy is currently being updated. Please check back later.'
            ]);
        }
        
        return view('privacy-policy', compact('privacy'));
    }
}