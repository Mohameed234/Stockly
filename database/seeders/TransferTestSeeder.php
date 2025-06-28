<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Warehouse;
use App\Models\Item;

class TransferTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test warehouses
        $warehouseA = Warehouse::create([
            'name' => 'Warehouse A',
            'location' => 'Location A'
        ]);

        $warehouseB = Warehouse::create([
            'name' => 'Warehouse B',
            'location' => 'Location B'
        ]);

        // Create test items in Warehouse A
        Item::create([
            'type' => 'Product 1',
            'measurement' => 'Pieces',
            'amount' => 100,
            'qrcode' => 'QR001',
            'in_date' => now(),
            'expire_date' => now()->addMonths(6),
            'get_from' => 'Supplier A',
            'get_to' => 'Warehouse A',
            'get_out_date' => null,
            'amount_get_in' => 100,
            'warehouse_id' => $warehouseA->id
        ]);

        Item::create([
            'type' => 'Product 2',
            'measurement' => 'Boxes',
            'amount' => 50,
            'qrcode' => 'QR002',
            'in_date' => now(),
            'expire_date' => now()->addMonths(12),
            'get_from' => 'Supplier B',
            'get_to' => 'Warehouse A',
            'get_out_date' => null,
            'amount_get_in' => 50,
            'warehouse_id' => $warehouseA->id
        ]);

        Item::create([
            'type' => 'Product 3',
            'measurement' => 'Units',
            'amount' => 75,
            'qrcode' => 'QR003',
            'in_date' => now(),
            'expire_date' => now()->addMonths(3),
            'get_from' => 'Supplier C',
            'get_to' => 'Warehouse A',
            'get_out_date' => null,
            'amount_get_in' => 75,
            'warehouse_id' => $warehouseA->id
        ]);

        // Create test items in Warehouse B
        Item::create([
            'type' => 'Product 4',
            'measurement' => 'Pieces',
            'amount' => 25,
            'qrcode' => 'QR004',
            'in_date' => now(),
            'expire_date' => now()->addMonths(8),
            'get_from' => 'Supplier D',
            'get_to' => 'Warehouse B',
            'get_out_date' => null,
            'amount_get_in' => 25,
            'warehouse_id' => $warehouseB->id
        ]);

        Item::create([
            'type' => 'Product 5',
            'measurement' => 'Boxes',
            'amount' => 30,
            'qrcode' => 'QR005',
            'in_date' => now(),
            'expire_date' => now()->addMonths(9),
            'get_from' => 'Supplier E',
            'get_to' => 'Warehouse B',
            'get_out_date' => null,
            'amount_get_in' => 30,
            'warehouse_id' => $warehouseB->id
        ]);

        $this->command->info('Test warehouses and items created successfully!');
        $this->command->info('Warehouse A has 3 items');
        $this->command->info('Warehouse B has 2 items');
    }
}
