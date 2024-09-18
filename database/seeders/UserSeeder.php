<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Celso',
                'email' => 'celso@lunegravacoes.com.br',
                'password' => Hash::make('12345678'),
                'role_id' => 1,
            ],
            [
                'name' => 'Gisele',
                'email' => 'gisele@lunegravacoes.com.br',
                'password' => Hash::make('12345678'),
                'role_id' => 2,
            ],
        ]);
    }
}
