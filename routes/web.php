<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\TransferController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Item routes
    Route::get('/items/expiring', [ItemController::class, 'expiring'])->name('items.expiring');
    Route::get('/items/received-today', [ItemController::class, 'receivedToday'])->name('items.received-today');
    Route::resource('items', ItemController::class);

    // Warehouse routes
    Route::resource('warehouses', WarehouseController::class);
    Route::get('/warehouses/{warehouse}/items', [WarehouseController::class, 'show'])->name('warehouses.show');

    // Transfer routes
    Route::get('/transfers', [TransferController::class, 'index'])->name('transfers.index');
    Route::get('/transfers/create', [TransferController::class, 'create'])->name('transfers.create');
    Route::post('/transfers', [TransferController::class, 'store'])->name('transfers.store');
    Route::get('/transfers/items-by-warehouse', [TransferController::class, 'getItemsByWarehouse'])->name('transfers.items-by-warehouse');
    Route::get('/transfers/{transfer}/details', [TransferController::class, 'show'])->name('transfers.show');

    // Test route for debugging
    Route::get('/test-items', function() {
        $warehouses = \App\Models\Warehouse::all();
        $items = \App\Models\Item::with('warehouse')->get();
        return response()->json([
            'warehouses' => $warehouses,
            'items' => $items
        ]);
    });

    // Simple test route without auth
    Route::get('/debug-data', function() {
        try {
            $warehouseCount = \App\Models\Warehouse::count();
            $itemCount = \App\Models\Item::count();
            $sampleItems = \App\Models\Item::with('warehouse')->take(3)->get();

            return response()->json([
                'success' => true,
                'warehouse_count' => $warehouseCount,
                'item_count' => $itemCount,
                'sample_items' => $sampleItems
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    });

    // Test transfer endpoint
    Route::get('/test-transfer/{warehouseId}', function($warehouseId) {
        try {
            $items = \App\Models\Item::where('warehouse_id', $warehouseId)
                ->where('amount', '>', 0)
                ->select(['id', 'type', 'amount', 'measurement'])
                ->orderBy('type', 'asc')
                ->orderBy('amount', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'warehouse_id' => $warehouseId,
                'items_count' => $items->count(),
                'items' => $items
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    });

    // Check database data
    Route::get('/check-data', function() {
        try {
            $warehouses = \App\Models\Warehouse::all(['id', 'name', 'location']);
            $items = \App\Models\Item::all(['id', 'type', 'amount', 'warehouse_id']);

            return response()->json([
                'success' => true,
                'warehouses' => $warehouses,
                'items' => $items,
                'warehouse_count' => $warehouses->count(),
                'item_count' => $items->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    });

    // Check item_warehouse pivot table
    Route::get('/check-pivot-table', function() {
        try {
            $pivotData = \Illuminate\Support\Facades\DB::table('item_warehouse')->get();
            $warehouses = \App\Models\Warehouse::all(['id', 'name']);
            $items = \App\Models\Item::all(['id', 'type']);

            return response()->json([
                'success' => true,
                'pivot_table_data' => $pivotData,
                'pivot_count' => $pivotData->count(),
                'warehouses' => $warehouses,
                'items' => $items
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    });

    // Show warehouse and item details
    Route::get('/warehouse-details', function() {
        try {
            $warehouses = \App\Models\Warehouse::all();

            $details = [];
            foreach ($warehouses as $warehouse) {
                // Get items from the item_warehouse pivot table
                $warehouseItems = \Illuminate\Support\Facades\DB::table('item_warehouse')
                    ->join('items', 'item_warehouse.item_id', '=', 'items.id')
                    ->where('item_warehouse.warehouse_id', $warehouse->id)
                    ->where('items.amount', '>', 0)
                    ->select([
                        'items.id',
                        'items.type',
                        'items.amount',
                        'items.measurement'
                    ])
                    ->get();

                $details[] = [
                    'warehouse_id' => $warehouse->id,
                    'warehouse_name' => $warehouse->name,
                    'items_count' => $warehouseItems->count(),
                    'items' => $warehouseItems
                ];
            }

            return response()->json([
                'success' => true,
                'details' => $details
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    });

    // Test Warehouse A specifically
    Route::get('/test-warehouse-a', function() {
        try {
            $warehouseA = \App\Models\Warehouse::where('name', 'Warehouse A')->first();

            if (!$warehouseA) {
                return response()->json([
                    'success' => false,
                    'error' => 'Warehouse A not found'
                ]);
            }

            // Get items from the item_warehouse pivot table
            $items = \Illuminate\Support\Facades\DB::table('item_warehouse')
                ->join('items', 'item_warehouse.item_id', '=', 'items.id')
                ->where('item_warehouse.warehouse_id', $warehouseA->id)
                ->where('items.amount', '>', 0)
                ->select([
                    'items.id',
                    'items.type',
                    'items.amount',
                    'items.measurement'
                ])
                ->orderBy('items.type', 'asc')
                ->orderBy('items.amount', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'warehouse' => [
                    'id' => $warehouseA->id,
                    'name' => $warehouseA->name,
                    'location' => $warehouseA->location
                ],
                'items_count' => $items->count(),
                'items' => $items
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    });

    // User routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Test item totals calculation
    Route::get('/test-item-totals', function() {
        try {
            // Get all items with their warehouse relationships
            $items = \App\Models\Item::with('warehouses')->get();

            $results = [];
            foreach ($items as $item) {
                $totalAmount = \App\Models\Item::where('type', $item->type)
                    ->where('measurement', $item->measurement)
                    ->sum('amount');

                $results[] = [
                    'item_id' => $item->id,
                    'type' => $item->type,
                    'measurement' => $item->measurement,
                    'individual_amount' => $item->amount,
                    'total_amount' => $totalAmount,
                    'warehouses' => $item->warehouses->pluck('name')->toArray(),
                    'warehouse_count' => $item->warehouses->count()
                ];
            }

            return response()->json([
                'success' => true,
                'items' => $results
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    });

    // Test the new quantity system
    Route::get('/test-quantities', function() {
        try {
            $results = [];

            // Get all items with their warehouse quantities
            $items = \App\Models\Item::with('warehouses')->get();

            foreach ($items as $item) {
                $warehouseQuantities = [];
                $totalQuantity = 0;

                foreach ($item->warehouses as $warehouse) {
                    $quantity = $warehouse->pivot->quantity;
                    $warehouseQuantities[] = [
                        'warehouse_name' => $warehouse->name,
                        'quantity' => $quantity
                    ];
                    $totalQuantity += $quantity;
                }

                $results[] = [
                    'item_id' => $item->id,
                    'item_type' => $item->type,
                    'item_amount' => $item->amount,
                    'total_warehouse_quantity' => $totalQuantity,
                    'warehouse_quantities' => $warehouseQuantities
                ];
            }

            return response()->json([
                'success' => true,
                'items' => $results
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    });

    // Test warehouse quantities display
    Route::get('/test-warehouse-quantities', function() {
        try {
            $warehouses = \App\Models\Warehouse::with(['items' => function($query) {
                $query->select('items.*', 'item_warehouse.quantity');
            }])->get();

            $results = [];
            foreach ($warehouses as $warehouse) {
                $warehouseItems = [];
                foreach ($warehouse->items as $item) {
                    $warehouseItems[] = [
                        'item_id' => $item->id,
                        'item_type' => $item->type,
                        'item_measurement' => $item->measurement,
                        'warehouse_quantity' => $item->pivot->quantity,
                        'total_item_amount' => $item->amount
                    ];
                }

                $results[] = [
                    'warehouse_id' => $warehouse->id,
                    'warehouse_name' => $warehouse->name,
                    'items_count' => $warehouse->items->count(),
                    'items' => $warehouseItems
                ];
            }

            return response()->json([
                'success' => true,
                'warehouses' => $results
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    });
});

require __DIR__.'/auth.php';
