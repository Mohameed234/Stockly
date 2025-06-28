<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PopulateItemWarehouseQuantities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:item-warehouse-quantities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate item_warehouse pivot table with quantities based on items.amount';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to populate item_warehouse quantities...');

        // Get all items with their warehouse relationships
        $items = DB::table('items')
            ->join('item_warehouse', 'items.id', '=', 'item_warehouse.item_id')
            ->select([
                'items.id as item_id',
                'items.amount',
                'item_warehouse.warehouse_id',
                'item_warehouse.quantity'
            ])
            ->get();

        $updated = 0;
        $created = 0;

        foreach ($items as $item) {
            // If quantity is 0 or null, set it to the item's amount
            if ($item->quantity == 0 || $item->quantity === null) {
                DB::table('item_warehouse')
                    ->where('item_id', $item->item_id)
                    ->where('warehouse_id', $item->warehouse_id)
                    ->update(['quantity' => $item->amount]);

                $updated++;
                $this->line("Updated item {$item->item_id} in warehouse {$item->warehouse_id} with quantity {$item->amount}");
            }
        }

        // Update items.amount to reflect the sum of warehouse quantities
        $this->info('Updating items.amount to reflect warehouse quantities...');

        $itemsToUpdate = DB::table('items')->get();

        foreach ($itemsToUpdate as $item) {
            $totalQuantity = DB::table('item_warehouse')
                ->where('item_id', $item->id)
                ->sum('quantity');

            DB::table('items')
                ->where('id', $item->id)
                ->update(['amount' => $totalQuantity]);
        }

        $this->info("Completed! Updated {$updated} item_warehouse records.");
        $this->info("Updated items.amount to reflect warehouse quantities.");
    }
}
