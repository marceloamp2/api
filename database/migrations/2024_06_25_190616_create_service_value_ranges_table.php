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
        Schema::create('service_value_ranges', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('from');
            $table->unsignedInteger('to');
            $table->decimal('unitary_value', 8, 2)->unsigned();

            $table->foreignId('service_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_value_ranges');
    }
};
