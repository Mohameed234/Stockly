<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Models\Item;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::with(['items' => function($query) {
            $query->select('items.*', 'item_warehouse.quantity');
        }])->latest()->paginate(10);
        return view('warehouses.index', compact('warehouses'));
    }

    public function show(Warehouse $warehouse)
    {
        $warehouse->load(['items' => function($query) {
            $query->select('items.*', 'item_warehouse.quantity');
        }]);
        return view('warehouses.show', compact('warehouse'));
    }

    public function create()
    {
        $items = Item::all();
        return view('warehouses.create', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'items' => 'nullable|array',
            'items.*' => 'exists:items,id'
        ]);

        $warehouse = Warehouse::create([
            'name' => $validated['name'],
            'location' => $validated['location']
        ]);

        if (!empty($validated['items'])) {
            $warehouse->items()->attach($validated['items']);
        }

        return redirect()->route('warehouses.index')
            ->with('success', 'Warehouse created successfully.');
    }

    public function edit(Warehouse $warehouse)
    {
        $items = Item::all();
        return view('warehouses.edit', compact('warehouse', 'items'));
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'items' => 'nullable|array',
            'items.*' => 'exists:items,id'
        ]);

        $warehouse->update([
            'name' => $validated['name'],
            'location' => $validated['location']
        ]);

        // Sync the items (this will add new ones and remove old ones)
        $warehouse->items()->sync($validated['items'] ?? []);

        return redirect()->route('warehouses.index')
            ->with('success', 'Warehouse updated successfully.');
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        return redirect()->route('warehouses.index')
            ->with('success', 'Warehouse deleted successfully.');
    }
}
