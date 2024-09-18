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
        Schema::create('cash_flows', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['opening', 'closure', 'in', 'out']);
            $table->decimal('current_balance', 8, 2)->unsigned();
            $table->decimal('value', 8, 2)->unsigned();
            $table->string('description');

            $table->foreignId('payment_method_id')->constrained();
            $table->foreignId('bills_to_pay_id')->nullable()->constrained();
            $table->foreignId('company_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_flows');
    }
};
