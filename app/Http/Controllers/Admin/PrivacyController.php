<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Privacy;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    /**
     * Display a listing of the privacy policies.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $policies = Privacy::orderBy('created_at', 'desc')->get();
        return view('admin.privacy.index', compact('policies'));
    }

    /**
     * Show the form for creating a new privacy policy.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.privacy.create');
    }

    /**
     * Store a newly created privacy policy in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'status' => 'required|in:active,inactive',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // If this is set as default, update all other policies to non-default
        if ($request->has('is_default') && $request->is_default) {
            Privacy::where('is_default', true)->update(['is_default' => false]);
        }
        
        // If this is set as active and there's another active policy, update status of other policies
        if ($request->status === 'active' && Privacy::active()->exists()) {
            Privacy::active()->update(['status' => 'inactive']);
        }

        Privacy::create($request->all());

        return redirect()->route('admin.privacy.index')
            ->with('success', 'Privacy policy created successfully.');
    }

    /**
     * Show the form for editing the specified privacy policy.
     *
     * @param  \App\Models\Admin\Privacy  $privacy
     * @return \Illuminate\View\View
     */
    public function edit(Privacy $privacy)
    {
        return view('admin.privacy.edit', compact('privacy'));
    }

    /**
     * Update the specified privacy policy in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Privacy  $privacy
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Privacy $privacy)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'status' => 'required|in:active,inactive',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // If this is set as default, update all other policies to non-default
        if ($request->has('is_default') && $request->is_default) {
            Privacy::where('id', '!=', $privacy->id)
                  ->where('is_default', true)
                  ->update(['is_default' => false]);
        }
        
        // If this is set as active and there's another active policy, update status of other policies
        if ($request->status === 'active' && $privacy->status !== 'active') {
            Privacy::where('id', '!=', $privacy->id)
                  ->where('status', 'active')
                  ->update(['status' => 'inactive']);
        }

        $privacy->update($request->all());

        return redirect()->route('admin.privacy.index')
            ->with('success', 'Privacy policy updated successfully.');
    }

    /**
     * Remove the specified privacy policy from storage.
     *
     * @param  \App\Models\Admin\Privacy  $privacy
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Privacy $privacy)
    {
        if ($privacy->is_default) {
            return redirect()->route('admin.privacy.index')
                ->with('error', 'Cannot delete the default privacy policy.');
        }

        $privacy->delete();

        return redirect()->route('admin.privacy.index')
            ->with('success', 'Privacy policy deleted successfully.');
    }
}