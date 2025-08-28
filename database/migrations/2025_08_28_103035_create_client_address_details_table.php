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
        Schema::create('student_addresses', function (Blueprint $table) {
            $table->id();

            $table->text('uk_address')->nullable();
            $table->string('uk_postcode', 20)->nullable();

            $table->text('overseas_address')->nullable();
            $table->string('overseas_postcode', 20)->nullable();

            // Foreign key references (optional - add foreign constraints if needed)
            $table->unsignedBigInteger('basic_info_id')->nullable();
            $table->unsignedBigInteger('iso_countrylist_id')->nullable();
            $table->unsignedBigInteger('enquiry_id')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_address_details');
    }
};
