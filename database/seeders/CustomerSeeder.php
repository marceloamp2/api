<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            [
                'person_type' => 'pf',
                'phone' => '99 9999-9999',
                'cellphone' => '99 99999-9999',
                'email' => 'contato@gmail.com',
            ],
            [
                'person_type' => 'pf',
                'phone' => '99 9999-9999',
                'cellphone' => '99 99999-9999',
                'email' => 'contato@gmail.com',
            ],
            [
                'person_type' => 'pj',
                'phone' => '99 9999-9999',
                'cellphone' => '99 99999-9999',
                'email' => 'contato@gmail.com',
            ],
        ]);

        DB::table('natural_people')->insert([
            [
                'name' => 'Cliente 1',
                'cpf' => '999.999.999-99',
                'natural_personable_id' => 1,
                'natural_personable_type' => 'customer',
            ],
            [
                'name' => 'Cliente 2',
                'cpf' => '888.888.888-88',
                'natural_personable_id' => 2,
                'natural_personable_type' => 'customer',
            ],
        ]);

        DB::table('legal_people')->insert([
            [
                'cnpj' => '88.888.888/8888-88',
                'company' => 'Cliente X',
                'trade' => 'Cliente X',
                'contact' => 'Gabriela',
                'legal_personable_id' => 3,
                'legal_personable_type' => 'customer',
            ],
        ]);

        DB::table('addresses')->insert([
            [
                'zipcode' => '88888888',
                'address' => 'Rua X',
                'number' => '3000',
                'complement' => 'Sala 1',
                'neighborhood' => 'Vila Olimpia',
                'city' => 'São Paulo',
                'state' => 'São Paulo',
                'addressable_id' => 1,
                'addressable_type' => 'customer',
            ],
            [
                'zipcode' => '77777777',
                'address' => 'Rua Y',
                'number' => '3000',
                'complement' => 'Sala 1',
                'neighborhood' => 'Vila Olimpia',
                'city' => 'São Paulo',
                'state' => 'São Paulo',
                'addressable_id' => 2,
                'addressable_type' => 'customer',
            ],
            [
                'zipcode' => '66666666',
                'address' => 'Rua Z',
                'number' => '3000',
                'complement' => 'Sala 1',
                'neighborhood' => 'Vila Olimpia',
                'city' => 'São Paulo',
                'state' => 'São Paulo',
                'addressable_id' => 3,
                'addressable_type' => 'customer',
            ],
        ]);
    }
}
