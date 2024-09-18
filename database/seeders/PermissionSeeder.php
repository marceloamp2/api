<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            // User
            [
                'name' => 'index-users',
                'label' => 'Visualizar usuários',
                'group' => 'user',
                'group_label' => 'Usuário',
            ],
            [
                'name' => 'store-user',
                'label' => 'Criar usuário',
                'group' => 'user',
                'group_label' => 'Usuário',
            ],
            [
                'name' => 'update-user',
                'label' => 'Editar usuário',
                'group' => 'user',
                'group_label' => 'Usuário',
            ],
            [
                'name' => 'delete-user',
                'label' => 'Apagar usuário',
                'group' => 'user',
                'group_label' => 'Usuário',
            ],
            // Role
            [
                'name' => 'index-roles',
                'label' => 'Visualizar cargos',
                'group' => 'role',
                'group_label' => 'Cargo',
            ],
            [
                'name' => 'store-role',
                'label' => 'Criar cargo',
                'group' => 'role',
                'group_label' => 'Cargo',
            ],
            [
                'name' => 'update-role',
                'label' => 'Editar cargo',
                'group' => 'role',
                'group_label' => 'Cargo',
            ],
            [
                'name' => 'delete-role',
                'label' => 'Apagar cargo',
                'group' => 'role',
                'group_label' => 'Cargo',
            ],
            // Supplier
            [
                'name' => 'index-suppliers',
                'label' => 'Visualizar fornecedores',
                'group' => 'supplier',
                'group_label' => 'Fornecedor',
            ],
            [
                'name' => 'store-supplier',
                'label' => 'Criar fornecedor',
                'group' => 'supplier',
                'group_label' => 'Fornecedor',
            ],
            [
                'name' => 'update-supplier',
                'label' => 'Editar fornecedor',
                'group' => 'supplier',
                'group_label' => 'Fornecedor',
            ],
            [
                'name' => 'delete-supplier',
                'label' => 'Apagar fornecedor',
                'group' => 'supplier',
                'group_label' => 'Fornecedor',
            ],
            // Expense
            [
                'name' => 'index-expenses',
                'label' => 'Visualizar despesas',
                'group' => 'expense',
                'group_label' => 'Despesa',
            ],
            [
                'name' => 'store-expense',
                'label' => 'Criar despesa',
                'group' => 'expense',
                'group_label' => 'Despesa',
            ],
            [
                'name' => 'update-expense',
                'label' => 'Editar despesa',
                'group' => 'expense',
                'group_label' => 'Despesa',
            ],
            [
                'name' => 'delete-expense',
                'label' => 'Apagar despesa',
                'group' => 'expense',
                'group_label' => 'Despesa',
            ],
            // Input
            [
                'name' => 'index-inputs',
                'label' => 'Visualizar insumos',
                'group' => 'input',
                'group_label' => 'Insumo',
            ],
            [
                'name' => 'store-input',
                'label' => 'Criar insumo',
                'group' => 'input',
                'group_label' => 'Insumo',
            ],
            [
                'name' => 'update-input',
                'label' => 'Editar insumo',
                'group' => 'input',
                'group_label' => 'Insumo',
            ],
            [
                'name' => 'delete-input',
                'label' => 'Apagar insumo',
                'group' => 'input',
                'group_label' => 'Insumo',
            ],
            // Service
            [
                'name' => 'index-services',
                'label' => 'Visualizar serviços',
                'group' => 'service',
                'group_label' => 'Serviço',
            ],
            [
                'name' => 'store-service',
                'label' => 'Criar serviço',
                'group' => 'service',
                'group_label' => 'Serviço',
            ],
            [
                'name' => 'update-service',
                'label' => 'Editar serviço',
                'group' => 'service',
                'group_label' => 'Serviço',
            ],
            [
                'name' => 'delete-service',
                'label' => 'Apagar serviço',
                'group' => 'service',
                'group_label' => 'Serviço',
            ],
            // Cliente
            [
                'name' => 'index-customers',
                'label' => 'Visualizar clientes',
                'group' => 'customer',
                'group_label' => 'Cliente',
            ],
            [
                'name' => 'store-customer',
                'label' => 'Criar cliente',
                'group' => 'customer',
                'group_label' => 'Cliente',
            ],
            [
                'name' => 'update-customer',
                'label' => 'Editar cliente',
                'group' => 'customer',
                'group_label' => 'Cliente',
            ],
            [
                'name' => 'delete-customer',
                'label' => 'Apagar cliente',
                'group' => 'customer',
                'group_label' => 'Cliente',
            ],
        ]);
    }
}
