<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            [
                'name' => 'credit_card',
                'label' => 'Cartão de crédito',
            ],
            [
                'name' => 'debit_card',
                'label' => 'Cartão de débito',
            ],
            [
                'name' => 'pix',
                'label' => 'Pix',
            ],
            [
                'name' => 'cash',
                'label' => 'Dinheiro',
            ],
        ]);
    }
}
