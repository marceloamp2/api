<?php

namespace Database\Seeders;

use App\Models\Input;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inputs = Input::all();

        foreach ($inputs as $input) {
            DB::table('stocks')->insert([
                [
                    'quantity' => 0,
                    'input_id' => $input->id,
                ],
            ]);
        }
    }
}
