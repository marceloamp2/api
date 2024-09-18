<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            [
                'person_type' => 'pj',
                'phone' => '99 9999-9999',
                'cellphone' => '99 99999-9999',
                'email' => 'contato@gmail.com',
            ],
        ]);

        DB::table('legal_people')->insert([
            [
                'cnpj' => '99.999.999/9999-99',
                'company' => 'Fornecedor 1',
                'trade' => 'Fornecedor 1',
                'contact' => 'Paulo',
                'legal_personable_id' => 1,
                'legal_personable_type' => 'supplier',
            ],
        ]);

        DB::table('addresses')->insert([
            [
                'zipcode' => '99999999',
                'address' => 'Rua X',
                'number' => '3000',
                'complement' => 'Sala 1',
                'neighborhood' => 'Vila Olimpia',
                'city' => 'São Paulo',
                'state' => 'São Paulo',
                'addressable_id' => 1,
                'addressable_type' => 'supplier',
            ],
        ]);
    }
}
