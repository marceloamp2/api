<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('expenses')->insert([
            [
                'name' => 'Aluguel',
                'type' => 'fixed',
            ],
            [
                'name' => 'Luz',
                'type' => 'variable',
            ],
            [
                'name' => 'Salário',
                'type' => 'fixed',
            ],
            [
                'name' => 'Bônus',
                'type' => 'variable',
            ],
            [
                'name' => 'Telefone',
                'type' => 'variable',
            ],
            [
                'name' => 'Internet',
                'type' => 'fixed',
            ],
            [
                'name' => 'Motoboy',
                'type' => 'variable',
            ],
            [
                'name' => 'Correios',
                'type' => 'variable',
            ],
            [
                'name' => 'Insumo',
                'type' => 'variable',
            ],
        ]);
    }
}
