<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillsToPaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bills_to_pays')->insert([
            [
                'due_date' => '2024-10-08',
                'payday' => '2024-10-08',
                'value' => 100,
                'note' => 'Observação',
                'payment_method_id' => 4,
                'expense_id' => 8,
            ],
            [
                'due_date' => '2024-10-08',
                'payday' => '2024-10-10',
                'value' => 200,
                'note' => 'Observação',
                'payment_method_id' => 3,
                'expense_id' => 9,
            ],
            [
                'due_date' => '2024-10-08',
                'payday' => null,
                'value' => 300,
                'note' => 'Observação',
                'payment_method_id' => null,
                'expense_id' => 7,
            ],
        ]);
    }
}
