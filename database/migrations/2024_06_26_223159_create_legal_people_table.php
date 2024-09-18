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
        Schema::create('legal_people', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj')->unique();
            $table->string('company');
            $table->string('trade');
            $table->string('contact');

            $table->unsignedInteger('legal_personable_id');
            $table->string('legal_personable_type');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_people');
    }
};
