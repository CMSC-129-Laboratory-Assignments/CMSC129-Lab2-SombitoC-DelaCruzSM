<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{
    /**
     * Display a listing of menu items.
     */
    public function index(Request $request)
    {
        $query = MenuItem::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'ILIKE', "%{$search}%")
                  ->orWhere('description', 'ILIKE', "%{$search}%");
        }
        // the ILIKE operator is used for case-INsensitive search in PostgreSQL, I know, it's weird.

        // Filter by availability
        if ($request->has('availability') && $request->availability != '') {
            $query->where('is_available', $request->availability);
        }

        // Paginate results
        $menuItems = $query->latest()->paginate(10)->withQueryString();
        // without this, the pagination links will lose the search and filter query parameters, which is not good for UX

        return view('menu-items.index', compact('menuItems'));
    }

    /**
     * Show the form for creating a new menu item.
     */
    public function create()
    {
        return view('menu-items.create');
    }

    /**
     * Store a newly created menu item in database.
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'full_price' => 'required|numeric|min:0',
            'half_price' => 'nullable|numeric|min:0|lt:full_price',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'required|boolean',
        ]); // nullable means "optional"

        // Handle file upload (for photos of menu items)
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('menu-items', 'public');
        }

        // Create menu item
        MenuItem::create($validated);

        return redirect()->route('menu-items.index')
                         ->with('success', 'Menu item created successfully!');
    }

    /**
     * Display the specified menu item.
     */
    public function show(MenuItem $menuItem)
    {
        return view('menu-items.show', compact('menuItem'));
    } // use compact to pass the menuItem variable to the view, so we can display its details in the show.blade.php view

    /**
     * Show the form for editing the specified menu item.
     */
    public function edit(MenuItem $menuItem)
    {
        return view('menu-items.edit', compact('menuItem'));
    }

    /**
     * Update the specified menu item in database.
     */
    public function update(Request $request, MenuItem $menuItem)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'full_price' => 'required|numeric|min:0',
            'half_price' => 'nullable|numeric|min:0|lt:full_price',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'required|boolean',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($menuItem->image) {
                Storage::disk('public')->delete($menuItem->image);
            }
            $validated['image'] = $request->file('image')->store('menu-items', 'public');
        }

        // Update menu item
        $menuItem->update($validated);

        return redirect()->route('menu-items.index')
                         ->with('success', 'Menu item updated successfully!');
    }

    /**
     * Soft delete the specified menu item.
     */
    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete(); // Soft delete

        return redirect()->route('menu-items.index')
                         ->with('success', 'Menu item moved to trash!');
    }

    /**
     * Display trashed menu items.
     */
    public function trashed()
    {
        $menuItems = MenuItem::onlyTrashed()->latest()->paginate(10);
        return view('menu-items.trashed', compact('menuItems'));
    }

    /**
     * Restore a soft-deleted menu item.
     */
    public function restore($id)
    {
        $menuItem = MenuItem::onlyTrashed()->findOrFail($id);
        $menuItem->restore();

        return redirect()->route('menu-items.trashed')
                         ->with('success', 'Menu item restored successfully!');
    }

    /**
     * Permanently delete a menu item.
     */
    public function forceDelete($id)
    {
        $menuItem = MenuItem::onlyTrashed()->findOrFail($id);

        // Delete image file
        if ($menuItem->image) {
            Storage::disk('public')->delete($menuItem->image);
        }

        $menuItem->forceDelete(); // Permanent delete

        return redirect()->route('menu-items.trashed')
                         ->with('success', 'Menu item permanently deleted!');
    }
}