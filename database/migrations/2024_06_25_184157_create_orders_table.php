<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_value', 8, 2)->unsigned();
            $table->decimal('sedex', 8, 2)->unsigned();
            $table->decimal('discount', 8, 2)->unsigned();
            $table->string('note')->nullable();
            $table->enum('status', ['waiting', 'in_production', 'delivered', 'cancelled'])->default('waiting');

            $table->foreignId('customer_id')->constrained();
            $table->foreignId('payment_method_id')->constrained();
            $table->foreignId('company_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
