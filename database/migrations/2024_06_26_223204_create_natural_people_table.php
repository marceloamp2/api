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
        Schema::create('natural_people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cpf')->unique();

            $table->unsignedInteger('natural_personable_id');
            $table->string('natural_personable_type');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('natural_people');
    }
};
