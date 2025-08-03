<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInventoryItemRequest;
use App\Http\Requests\UpdateInventoryItemRequest;
use App\Models\Employee;
use App\Models\InventoryCategory;
use App\Models\InventoryItem;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InventoryItemController extends Controller
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
        $status = $request->get('status');
        $category = $request->get('category');
        
        $items = InventoryItem::query()
            ->with(['category', 'assignedEmployee'])
            ->when($search, function ($query, $search) {
                return $query->where('name', 'ilike', "%{$search}%")
                    ->orWhere('serial_number', 'ilike', "%{$search}%")
                    ->orWhere('brand', 'ilike', "%{$search}%")
                    ->orWhere('model', 'ilike', "%{$search}%");
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->orderBy('name')
            ->paginate(10);

        $categories = InventoryCategory::orderBy('name')->get();

        return Inertia::render('inventory-items/index', [
            'items' => $items,
            'categories' => $categories,
            'search' => $search,
            'status' => $status,
            'category' => $category,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->ensureAdmin();
        
        $categories = InventoryCategory::orderBy('name')->get();
        $employees = Employee::orderBy('name')->get();

        return Inertia::render('inventory-items/create', [
            'categories' => $categories,
            'employees' => $employees,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventoryItemRequest $request)
    {
        $this->ensureAdmin();
        
        $item = InventoryItem::create($request->validated());

        return redirect()->route('inventory-items.show', $item)
            ->with('success', 'Inventory item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryItem $inventoryItem)
    {
        $this->ensureAdmin();
        
        $inventoryItem->load(['category', 'assignedEmployee']);
        
        return Inertia::render('inventory-items/show', [
            'item' => $inventoryItem
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InventoryItem $inventoryItem)
    {
        $this->ensureAdmin();
        
        $categories = InventoryCategory::orderBy('name')->get();
        $employees = Employee::orderBy('name')->get();

        return Inertia::render('inventory-items/edit', [
            'item' => $inventoryItem,
            'categories' => $categories,
            'employees' => $employees,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventoryItemRequest $request, InventoryItem $inventoryItem)
    {
        $this->ensureAdmin();
        
        $inventoryItem->update($request->validated());

        return redirect()->route('inventory-items.show', $inventoryItem)
            ->with('success', 'Inventory item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InventoryItem $inventoryItem)
    {
        $this->ensureAdmin();
        
        $inventoryItem->delete();

        return redirect()->route('inventory-items.index')
            ->with('success', 'Inventory item deleted successfully.');
    }
}