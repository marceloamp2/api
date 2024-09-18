<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CompanySeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(InputSeeder::class);
        $this->call(ExpenseSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(StockSeeder::class);
        $this->call(StockMovementSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(BillsToPaySeeder::class);
    }
}
