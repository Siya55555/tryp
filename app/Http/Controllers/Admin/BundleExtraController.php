<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BundleExtra;
use App\Models\Admin\Bundle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BundleExtraController extends Controller
{
    /**
     * Display a listing of bundle extras.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = BundleExtra::with('bundle');
        
        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('bundle', function($subQuery) use ($search) {
                      $subQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        // Filter by bundle
        if ($request->has('bundle_id') && $request->bundle_id != '') {
            $query->where('bundle_id', $request->bundle_id);
        }
        
        $bundleExtras = $query->latest()->paginate(10);
        $bundles = Bundle::all();
        
        return view('admin.bundle-extras.index', compact('bundleExtras', 'bundles'));
    }

    /**
     * Show the form for creating a new bundle extra.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $bundle_id = $request->query('bundle_id');
        $bundle = Bundle::findOrFail($bundle_id);
        return view('admin.bundle-extras.create', compact('bundle'));
    }

    /**
     * Store a newly created bundle extra.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'bundle_id' => 'required|exists:bundles,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url',
        ]);

        $extraData = [
            'bundle_id' => $request->bundle_id,
            'title' => $request->title,
            'description' => $request->description,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('bundle-extras', 'public');
            $extraData['image'] = 'storage/' . $path;
        } elseif ($request->filled('image_url')) {
            $extraData['image'] = $request->image_url;
        }

        $bundleExtra = BundleExtra::create($extraData);

        return redirect()
            ->route('admin.bundles.edit', $request->bundle_id)
            ->with('success', 'Bundle extra created successfully.');
    }

    /**
     * Show the form for editing a bundle extra.
     *
     * @param BundleExtra $bundleExtra
     * @return \Illuminate\View\View
     */
    public function edit(BundleExtra $bundleExtra)
    {
        return view('admin.bundle-extras.edit', compact('bundleExtra'));
    }

    /**
     * Update the specified bundle extra.
     *
     * @param Request $request
     * @param BundleExtra $bundleExtra
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, BundleExtra $bundleExtra)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url',
        ]);

        $extraData = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it's a local file
            if ($bundleExtra->image && Str::startsWith($bundleExtra->image, 'storage/')) {
                Storage::delete(str_replace('storage/', 'public/', $bundleExtra->image));
            }

            $path = $request->file('image')->store('bundle-extras', 'public');
            $extraData['image'] = 'storage/' . $path;
        } elseif ($request->filled('image_url')) {
            // Delete old image if it's a local file
            if ($bundleExtra->image && Str::startsWith($bundleExtra->image, 'storage/')) {
                Storage::delete(str_replace('storage/', 'public/', $bundleExtra->image));
            }

            $extraData['image'] = $request->image_url;
        }

        $bundleExtra->update($extraData);

        return redirect()
            ->route('admin.bundles.edit', $bundleExtra->bundle_id)
            ->with('success', 'Bundle extra updated successfully.');
    }

    /**
     * Remove the specified bundle extra.
     *
     * @param BundleExtra $bundleExtra
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(BundleExtra $bundleExtra)
    {
        $bundleId = $bundleExtra->bundle_id;

        // Delete associated image if it's a local file
        if ($bundleExtra->image && Str::startsWith($bundleExtra->image, 'storage/')) {
            Storage::delete(str_replace('storage/', 'public/', $bundleExtra->image));
        }

        $bundleExtra->delete();

        return redirect()
            ->route('admin.bundles.edit', $bundleId)
            ->with('success', 'Bundle extra deleted successfully.');
    }

    /**
     * Get bundle extras for a specific bundle via AJAX.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBundleExtras(Request $request)
    {
        $bundleId = $request->input('bundle_id');
        
        $extras = BundleExtra::where('bundle_id', $bundleId)
            ->select('id', 'title', 'description', 'image')
            ->get();
        
        return response()->json($extras);
    }
}