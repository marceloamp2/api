<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            [
                'total_value' => 110,
                'sedex' => 15,
                'discount' => 5,
                'note' => null,
                'status' => 'waiting',
                'customer_id' => 1,
                'payment_method_id' => 1,
                'company_id' => 1,
                'created_at' => now(),
            ],
        ]);

        DB::table('projects')->insert([
            [
                'brand' => 'Marca X',
                'order_id' => 1,
            ],
            [
                'brand' => 'Marca Y',
                'order_id' => 1,
            ],
        ]);

        DB::table('project_service')->insert([
            [
                'project_id' => 1,
                'service_id' => 1,
                'quantity' => 10,
                'unitary_value' => 2,
                'total_value' => 20,
            ],
            [
                'project_id' => 1,
                'service_id' => 2,
                'quantity' => 10,
                'unitary_value' => 2,
                'total_value' => 20,
            ],
            [
                'project_id' => 2,
                'service_id' => 3,
                'quantity' => 60,
                'unitary_value' => 1,
                'total_value' => 60,
            ],
        ]);
    }
}
