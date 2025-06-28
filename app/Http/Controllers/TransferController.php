<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Warehouse;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    public function index()
    {
        $transfers = StockMovement::with(['item', 'fromWarehouse', 'toWarehouse', 'user'])
            ->latest('transfer_date')
            ->paginate(10);

        return view('transfers.index', compact('transfers'));
    }

    public function create()
    {
        $warehouses = Warehouse::all();
        return view('transfers.create', compact('warehouses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'from_warehouse_id' => 'required|exists:warehouses,id',
            'to_warehouse_id' => 'required|exists:warehouses,id|different:from_warehouse_id',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'transfer_date' => 'required|date',
            'notes' => 'nullable|string|max:500',
        ]);

        // Check if item exists in the source warehouse and has enough quantity
        $itemInWarehouse = DB::table('item_warehouse')
            ->where('warehouse_id', $request->from_warehouse_id)
            ->where('item_id', $request->item_id)
            ->first();

        if (!$itemInWarehouse) {
            return back()->withErrors(['item_id' => 'This item is not available in the selected source warehouse.']);
        }

        // Check if there's enough quantity in the source warehouse
        if ($itemInWarehouse->quantity < $request->quantity) {
            return back()->withErrors(['quantity' => 'Insufficient quantity available for transfer.']);
        }

        DB::beginTransaction();
        try {
            // Create the transfer record
            $transfer = StockMovement::create([
                'item_id' => $request->item_id,
                'from_warehouse_id' => $request->from_warehouse_id,
                'to_warehouse_id' => $request->to_warehouse_id,
                'quantity' => $request->quantity,
                'transfer_date' => $request->transfer_date,
                'notes' => $request->notes,
                'user_id' => auth()->id(),
            ]);

            // Update quantities in the pivot table
            // Reduce quantity from source warehouse
            DB::table('item_warehouse')
                ->where('warehouse_id', $request->from_warehouse_id)
                ->where('item_id', $request->item_id)
                ->update(['quantity' => $itemInWarehouse->quantity - $request->quantity]);

            // Remove from source warehouse if quantity becomes 0
            if ($itemInWarehouse->quantity - $request->quantity <= 0) {
                DB::table('item_warehouse')
                    ->where('warehouse_id', $request->from_warehouse_id)
                    ->where('item_id', $request->item_id)
                    ->delete();
            }

            // Add to destination warehouse
            $existingInDest = DB::table('item_warehouse')
                ->where('warehouse_id', $request->to_warehouse_id)
                ->where('item_id', $request->item_id)
                ->first();

            if ($existingInDest) {
                // Update existing record
                DB::table('item_warehouse')
                    ->where('warehouse_id', $request->to_warehouse_id)
                    ->where('item_id', $request->item_id)
                    ->update(['quantity' => $existingInDest->quantity + $request->quantity]);
            } else {
                // Create new record
                DB::table('item_warehouse')->insert([
                    'warehouse_id' => $request->to_warehouse_id,
                    'item_id' => $request->item_id,
                    'quantity' => $request->quantity,
                ]);
            }

            // Update the item's total amount (sum of all warehouse quantities)
            $totalAmount = DB::table('item_warehouse')
                ->where('item_id', $request->item_id)
                ->sum('quantity');

            $item = Item::findOrFail($request->item_id);
            $item->amount = $totalAmount;
            $item->save();

            DB::commit();

            return redirect()->route('transfers.index')
                ->with('success', 'Transfer completed successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Transfer error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred while processing the transfer.']);
        }
    }

    public function show(StockMovement $transfer)
    {
        $transfer->load(['item', 'fromWarehouse', 'toWarehouse', 'user']);
        return view('transfers.show', compact('transfer'));
    }

    public function getItemsByWarehouse(Request $request)
    {
        try {
            $warehouseId = $request->warehouse_id;

            if (!$warehouseId) {
                return response()->json(['error' => 'Warehouse ID is required'], 400);
            }

            // Check if warehouse exists
            $warehouse = Warehouse::find($warehouseId);
            if (!$warehouse) {
                return response()->json(['error' => 'Warehouse not found'], 404);
            }

            // Get items from the item_warehouse pivot table with quantities
            $items = DB::table('item_warehouse')
                ->join('items', 'item_warehouse.item_id', '=', 'items.id')
                ->where('item_warehouse.warehouse_id', $warehouseId)
                ->where('item_warehouse.quantity', '>', 0)
                ->select([
                    'items.id',
                    'items.type',
                    'item_warehouse.quantity as amount',
                    'items.measurement'
                ])
                ->orderBy('items.type', 'asc')
                ->orderBy('item_warehouse.quantity', 'desc')
                ->get();

            return response()->json($items);

        } catch (\Exception $e) {
            \Log::error('Error fetching items by warehouse: ' . $e->getMessage());
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }
}
