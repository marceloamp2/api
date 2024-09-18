<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::morphMap([
            'company' => Company::class,
            'customer' => Customer::class,
            'supplier' => Supplier::class,
        ]);
    }
}
