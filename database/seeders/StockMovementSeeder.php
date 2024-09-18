<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockMovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stock_movements')->insert([
            [
                'type' => 'in',
                'total_value' => 300,
                'nf_number' => 1,
                'supplier_id' => 1,
                'created_at' => now(),
            ],
        ]);

        DB::table('input_stock_movement')->insert([
            [
                'input_id' => 1,
                'stock_movement_id' => 1,
                'quantity' => 10,
                'unitary_value' => 1,
                'total_value' => 10,
            ],
            [
                'input_id' => 2,
                'stock_movement_id' => 1,
                'quantity' => 10,
                'unitary_value' => 1,
                'total_value' => 10,
            ],
            [
                'input_id' => 3,
                'stock_movement_id' => 1,
                'quantity' => 10,
                'unitary_value' => 1,
                'total_value' => 10,
            ],
        ]);

        DB::table('stocks')
            ->where('id', 1)
            ->update([
                'quantity' => 10
            ]);

        DB::table('stocks')
            ->where('id', 2)
            ->update([
                'quantity' => 10
            ]);

        DB::table('stocks')
            ->where('id', 3)
            ->update([
                'quantity' => 10
            ]);
    }
}
