<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'name' => '01 Gravação a laser com pintura',
                'status' => 'active',
            ],
            [
                'name' => '02 Gravações a laser com pintura',
                'status' => 'active',
            ],
            [
                'name' => '03 Gravações com pintura lentes laser ou tampografia',
                'status' => 'active',
            ],
            [
                'name' => 'Gravação adicional com pintura',
                'status' => 'active',
            ],
            [
                'name' => '01 Gravação com tampografia 1 cor',
                'status' => 'active',
            ],
            [
                'name' => '02 Gravações com tampografia 1 cor',
                'status' => 'active',
            ],
            [
                'name' => '03 Gravações com tampografia 1 cor',
                'status' => 'active',
            ],
            [
                'name' => '01 Gravação com tampografia 2 cores',
                'status' => 'active',
            ],
            [
                'name' => '02 Gravações com tampografia 2 cores',
                'status' => 'active',
            ],
            [
                'name' => '03 Gravações com tampografia 2 cores',
                'status' => 'active',
            ],
            [
                'name' => '01 Gravação a laser sem pintura ',
                'status' => 'active',
            ],
            [
                'name' => '02 Gravações a laser sem pintura ',
                'status' => 'active',
            ],
            [
                'name' => '03 Gravações a laser sem pintura ',
                'status' => 'active',
            ],
            [
                'name' => 'Gravação adicional sem pintura',
                'status' => 'active',
            ],
            [
                'name' => 'Limpeza de lentes ou hastes',
                'status' => 'active',
            ],
            [
                'name' => 'Personalização em estojo a laser',
                'status' => 'active',
            ],
            [
                'name' => 'Personalização em estojo tampografia',
                'status' => 'active',
            ],
            [
                'name' => 'Personalização em flanela a laser',
                'status' => 'active',
            ],
            [
                'name' => 'Personalização em flanela tampografia',
                'status' => 'active',
            ],
            [
                'name' => '01 Personalização em copos ou garrafas',
                'status' => 'active',
            ],
            [
                'name' => '02 Personalizações em copos ou garrafas',
                'status' => 'active',
            ],
            [
                'name' => '03 Personalizações em copos ou garrafas',
                'status' => 'active',
            ],
            [
                'name' => 'Vetor',
                'status' => 'active',
            ],
            [
                'name' => 'Personalização em níquel',
                'status' => 'active',
            ],
            [
                'name' => 'Personalização em expositor',
                'status' => 'active',
            ],
        ]);

        $services = DB::table('services')->get();

        foreach ($services as $service) {
            DB::table('service_value_ranges')->insert([
                [
                    'from' => 1,
                    'to' => 49,
                    'unitary_value' => 2,
                    'service_id' => $service->id,
                ],
                [
                    'from' => 50,
                    'to' => 99,
                    'unitary_value' => 1,
                    'service_id' => $service->id,
                ],
            ]);
        }
    }
}
