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
        Schema::create('input_stock_movement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('input_id')->constrained();
            $table->foreignId('stock_movement_id')->constrained();
            $table->unsignedInteger('quantity');
            $table->decimal('unitary_value', 8, 2)->unsigned()->nullable();
            $table->decimal('total_value', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_stock_movement');
    }
};
