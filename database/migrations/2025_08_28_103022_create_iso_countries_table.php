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
        Schema::create('iso_countries', function (Blueprint $table) {
           $table->id();

            $table->string('title'); // Short name (e.g., Nepal)
            $table->string('iso_code')->nullable(); // ISO code (e.g., NPL)
            $table->string('long_name')->nullable(); // Full name (e.g., Federal Democratic Republic of Nepal)
            $table->string('num_code')->nullable(); // Numeric ISO code
            $table->string('alpa_2_code', 2)->nullable(); // Alpha-2 code (e.g., NP)
            $table->string('calling_code')->nullable(); // e.g., +977
            $table->integer('order')->nullable(); // For sorting/display order
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iso_countries');
    }
};
