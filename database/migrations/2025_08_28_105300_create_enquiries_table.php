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
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();

            $table->unsignedBigInteger('enquiry_type_id')->nullable();
            $table->string('referral')->nullable();
            $table->text('instruction')->nullable();
            $table->text('note')->nullable();

            $table->unsignedBigInteger('enquiry_assigned_to')->nullable();
            $table->unsignedBigInteger('country_mobile')->nullable();  // links to IsoCountry
            $table->unsignedBigInteger('country_tel')->nullable();     // links to IsoCountry

            $table->string('latest_status')->nullable();
            $table->string('status')->nullable();

            $table->unsignedBigInteger('raw_enquiry_id')->nullable();
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
