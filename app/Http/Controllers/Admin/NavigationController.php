<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\NavigationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NavigationController extends Controller
{
    /**
     * Display a listing of navigation items.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $navItems = NavigationItem::with('children')
                                  ->root()
                                  ->orderBy('position', 'asc')
                                  ->get();
        
        return view('admin.navigation.index', compact('navItems'));
    }

    /**
     * Show the form for creating a new navigation item.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $parentItems = NavigationItem::root()->get();
        
        return view('admin.navigation.create', compact('parentItems'));
    }

    /**
     * Store a newly created navigation item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:navigation_items,id',
            'position' => 'required|integer|min:0',
            'target' => 'required|in:_self,_blank'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Fixed checkbox handling - explicitly handle the is_active field
        $isActive = $request->has('is_active') ? true : false;

        NavigationItem::create([
            'title' => $request->title,
            'url' => $request->url,
            'parent_id' => $request->parent_id,
            'position' => $request->position,
            'is_active' => $isActive,
            'target' => $request->target
        ]);

        return redirect()->route('admin.navigation.index')
            ->with('success', 'Navigation item created successfully.');
    }

    /**
     * Show the form for editing the specified navigation item.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $navItem = NavigationItem::findOrFail($id);
        $parentItems = NavigationItem::root()
                                     ->where('id', '!=', $id)
                                     ->get();
        
        return view('admin.navigation.edit', compact('navItem', 'parentItems'));
    }

    /**
     * Update the specified navigation item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:navigation_items,id',
            'position' => 'required|integer|min:0',
            'target' => 'required|in:_self,_blank'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $navItem = NavigationItem::findOrFail($id);
        
        // Prevent setting item as its own parent
        if ($request->parent_id == $id) {
            return redirect()->back()
                ->withErrors(['parent_id' => 'A navigation item cannot be its own parent.'])
                ->withInput();
        }

        // Fixed checkbox handling - explicitly handle the is_active field
        $isActive = $request->has('is_active') ? true : false;

        $navItem->update([
            'title' => $request->title,
            'url' => $request->url,
            'parent_id' => $request->parent_id,
            'position' => $request->position,
            'is_active' => $isActive,
            'target' => $request->target
        ]);

        return redirect()->route('admin.navigation.index')
            ->with('success', 'Navigation item updated successfully.');
    }

    /**
     * Remove the specified navigation item from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $navItem = NavigationItem::findOrFail($id);
        $navItem->delete();

        return redirect()->route('admin.navigation.index')
            ->with('success', 'Navigation item deleted successfully.');
    }

    /**
     * Update the order of navigation items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrder(Request $request)
    {
        $items = $request->input('items', []);
        
        foreach ($items as $item) {
            $navItem = NavigationItem::findOrFail($item['id']);
            $navItem->update([
                'position' => $item['position'],
                'parent_id' => $item['parent_id'] ?? null
            ]);
        }

        return response()->json(['success' => true]);
    }
}