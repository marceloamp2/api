<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inputs')->insert([
            ['name' => 'Tinta branca re - tx 507 br'],
            ['name' => 'Tinta pink re - tx 507 br'],
            ['name' => 'Tinta prata re - tx 1080 r'],
            ['name' => 'Tinta vermelha re - 2tp133vr'],
            ['name' => 'Tinta preta re - 2tp075 pt'],
            ['name' => 'Tinta re - pp12800r'],
            ['name' => 'Tinta amarela re - pp011am'],
            ['name' => 'Tinta azul re - pp 013az'],
            ['name' => 'Tinta preta printcolor st black 750-33'],
            ['name' => 'Tinta branca printcolor s-t white 750-00'],
            ['name' => 'Clichê alumínio'],
            ['name' => 'Catalisador'],
            ['name' => 'Diluente cores'],
            ['name' => 'Diluente printcolor'],
            ['name' => 'Thinner limpeza 5 litros'],
            ['name' => 'Tampão tetinha'],
            ['name' => 'Tampão quadrado'],
            ['name' => 'Tampão estojos'],
            ['name' => 'Palha de aço'],
            ['name' => 'Flanela'],
            ['name' => 'Saco para limpeza (branco)'],
            ['name' => 'Giz stkamam branco'],
            ['name' => 'Giz stkamam dourado'],
            ['name' => 'Giz stkamam preto'],
            ['name' => 'Giz fosco'],
            ['name' => 'Giz poetica branco'],
            ['name' => 'Palito de dente'],
            ['name' => 'Alcool'],
            ['name' => 'Saco elastico'],
            ['name' => 'Saco lixo'],
            ['name' => 'Papel higiênico'],
            ['name' => 'Óleo de banana'],
            ['name' => 'Elastico pacte com 1000 unidades'],
            ['name' => 'Canetão (pincel)'],
            ['name' => 'Papel A4'],
            ['name' => 'Teclado'],
            ['name' => 'Mouse'],
            ['name' => 'Tinta impressora'],
            ['name' => 'Açúcar (cozinha)'],
            ['name' => 'Café (cozinha)'],
            ['name' => 'Leite em pó'],
            ['name' => 'Chocolate'],
            ['name' => 'Café'],
            ['name' => 'Copo de café'],
            ['name' => 'Copo de água'],
        ]);
    }
}
