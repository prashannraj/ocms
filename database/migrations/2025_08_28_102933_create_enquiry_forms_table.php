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
        Schema::create('enquiry_forms', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->uuid('uuid')->unique();
            $table->string('status')->default('pending'); // तपाईंको आवश्यकता अनुसार default राखिएको
            $table->string('type')->nullable(); // प्रकार optional छ भने nullable
            $table->timestamps(); // created_at र updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiry_forms');
    }
};
