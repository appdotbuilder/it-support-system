<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInventoryCategoryRequest;
use App\Http\Requests\UpdateInventoryCategoryRequest;
use App\Models\InventoryCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InventoryCategoryController extends Controller
{
    /**
     * Check if the user is an admin.
     */
    protected function ensureAdmin(): void
    {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized. Admin access required.');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->ensureAdmin();
        
        $search = $request->get('search');
        
        $categories = InventoryCategory::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'ilike', "%{$search}%")
                    ->orWhere('description', 'ilike', "%{$search}%");
            })
            ->withCount('inventoryItems')
            ->orderBy('name')
            ->paginate(10);

        return Inertia::render('inventory-categories/index', [
            'categories' => $categories,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->ensureAdmin();
        
        return Inertia::render('inventory-categories/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventoryCategoryRequest $request)
    {
        $this->ensureAdmin();
        
        $category = InventoryCategory::create($request->validated());

        return redirect()->route('inventory-categories.show', $category)
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryCategory $inventoryCategory)
    {
        $this->ensureAdmin();
        
        $inventoryCategory->load('inventoryItems.assignedEmployee');
        
        return Inertia::render('inventory-categories/show', [
            'category' => $inventoryCategory
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InventoryCategory $inventoryCategory)
    {
        $this->ensureAdmin();
        
        return Inertia::render('inventory-categories/edit', [
            'category' => $inventoryCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventoryCategoryRequest $request, InventoryCategory $inventoryCategory)
    {
        $this->ensureAdmin();
        
        $inventoryCategory->update($request->validated());

        return redirect()->route('inventory-categories.show', $inventoryCategory)
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InventoryCategory $inventoryCategory)
    {
        $this->ensureAdmin();
        
        $inventoryCategory->delete();

        return redirect()->route('inventory-categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}