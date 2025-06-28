<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        // Get unique item types with their total amounts from warehouse quantities
        $items = Item::select([
                'items.type',
                'items.measurement',
                'items.qrcode',
                'items.in_date',
                'items.expire_date',
                'items.get_from',
                'items.get_to',
                'items.get_out_date',
                'items.amount_get_in'
            ])
            ->selectRaw('COALESCE(SUM(item_warehouse.quantity), 0) as total_amount')
            ->selectRaw('MIN(items.id) as representative_id')
            ->leftJoin('item_warehouse', 'items.id', '=', 'item_warehouse.item_id')
            ->groupBy([
                'items.type',
                'items.measurement',
                'items.qrcode',
                'items.in_date',
                'items.expire_date',
                'items.get_from',
                'items.get_to',
                'items.get_out_date',
                'items.amount_get_in'
            ])
            ->orderBy('items.type', 'asc')
            ->orderBy('total_amount', 'desc')
            ->paginate(10);

        // Load warehouse information for each representative item
        foreach ($items as $item) {
            $representativeItem = Item::with('warehouses')->find($item->representative_id);
            $item->warehouses = $representativeItem->warehouses;
        }

        return view('items.index', compact('items'));
    }

    public function expiring()
    {
        $items = Item::with(['warehouse', 'warehouses'])
            ->whereNotNull('expire_date')
            ->where('expire_date', '<=', now()->addMonths(2))
            ->where('expire_date', '>', now())
            ->orderBy('expire_date', 'asc')
            ->paginate(10);

        return view('items.expiring', compact('items'));
    }

    public function receivedToday()
    {
        $items = Item::with(['warehouses'])
            ->whereRaw('DATE(in_date) = CURDATE()')
            ->orderBy('in_date', 'desc')
            ->get();

        return view('items.received-today', compact('items'));
    }

    public function create()
    {
        $warehouses = Warehouse::all();
        return view('items.create', compact('warehouses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'measurement' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'qrcode' => 'nullable|string|max:255|unique:items',
            'in_date' => 'required|date',
            'expire_date' => 'nullable|date|after:in_date',
            'get_from' => 'required|string|max:255',
            'get_to' => 'required|string|max:255',
            'get_out_date' => 'nullable|date',
            'amount_get_in' => 'required|numeric|min:0',
            'warehouse_id' => 'nullable|exists:warehouses,id',
            'warehouses' => 'nullable|array',
            'warehouses.*' => 'exists:warehouses,id'
        ]);

        $item = Item::create($validated);

        if (!empty($validated['warehouses'])) {
            $item->warehouses()->attach($validated['warehouses']);
        }

        return redirect()->route('items.index')
            ->with('success', 'Item created successfully.');
    }

    public function edit(Item $item)
    {
        $warehouses = Warehouse::all();
        return view('items.edit', compact('item', 'warehouses'));
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'measurement' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'qrcode' => 'nullable|string|max:255|unique:items,qrcode,' . $item->id,
            'in_date' => 'required|date',
            'expire_date' => 'nullable|date|after:in_date',
            'get_from' => 'required|string|max:255',
            'get_to' => 'required|string|max:255',
            'get_out_date' => 'nullable|date',
            'amount_get_in' => 'required|numeric|min:0',
            'warehouse_id' => 'nullable|exists:warehouses,id',
            'warehouses' => 'nullable|array',
            'warehouses.*' => 'exists:warehouses,id'
        ]);

        $item->update($validated);

        // Sync the warehouses (this will add new ones and remove old ones)
        $item->warehouses()->sync($validated['warehouses'] ?? []);

        return redirect()->route('items.index')
            ->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Item deleted successfully.');
    }
}
