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
        Schema::create('bills_to_pays', function (Blueprint $table) {
            $table->id();
            $table->date('due_date');
            $table->date('payday')->nullable();
            $table->decimal('value', 8, 2);
            $table->string('note')->nullable();
            $table->foreignId('payment_method_id')->nullable()->constrained();
            $table->foreignId('expense_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills_to_pays');
    }
};
