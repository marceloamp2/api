<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            [
                'phone' => '11 3313-5998',
                'cellphone' => '11 94046-6301',
                'email' => 'gravacaolune@gmail.com',
            ],
            [
                'phone' => null,
                'cellphone' => '11 97818 7372',
                'email' => 'luneexpress@gmail.com',
            ],
        ]);

        DB::table('legal_people')->insert([
            [
                'cnpj' => '27.648.058/0001-00',
                'company' => 'Lunê Gravação a Laser Ltda',
                'trade' => 'Lunê Gravações',
                'contact' => 'Celso',
                'legal_personable_id' => 1,
                'legal_personable_type' => 'company',
            ],
            [
                'cnpj' => '53.155.505/0001-91',
                'company' => 'C.A Lunê Gravação Ltda ',
                'trade' => 'Lunê Express',
                'contact' => 'Celso',
                'legal_personable_id' => 2,
                'legal_personable_type' => 'company',
            ],
        ]);

        DB::table('addresses')->insert([
            [
                'zipcode' => '01031-000',
                'address' => 'Av. Prestes Maia',
                'number' => '660-D',
                'complement' => null,
                'neighborhood' => 'Centro Histórico',
                'city' => 'São Paulo',
                'state' => 'São Paulo',
                'addressable_id' => 1,
                'addressable_type' => 'company',
            ],
            [
                'zipcode' => '01026-000',
                'address' => 'Av. Senador Queiroz,',
                'number' => '360',
                'complement' => 'Box 113',
                'neighborhood' => 'Centro Histórico',
                'city' => 'São Paulo',
                'state' => 'São Paulo',
                'addressable_id' => 2,
                'addressable_type' => 'company',
            ],
        ]);
    }
}
