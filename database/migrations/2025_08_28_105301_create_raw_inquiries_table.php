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
        Schema::create('raw_inquiries', function (Blueprint $table) {
           $table->id();

            $table->date('refusalLetterDate')->nullable();
            $table->boolean('refusalReceived')->nullable();
            $table->string('applicationLocation')->nullable();
            $table->string('uan')->nullable();
            $table->string('ho_ref')->nullable();

            $table->string('title')->nullable();
            $table->string('other_text')->nullable();
            $table->string('f_name')->nullable();
            $table->string('m_name')->nullable();
            $table->string('l_name')->nullable();
            $table->date('birthDate')->nullable();

            $table->unsignedBigInteger('country_iso_mobile')->nullable();
            $table->string('mobile')->nullable();
            $table->string('country_code')->nullable();

            $table->string('email')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('appellant_nation')->nullable();
            $table->text('appellant_address')->nullable();

            $table->boolean('has_uk_sponsor')->nullable();
            $table->string('sponsor_name')->nullable();
            $table->string('sponsor_relationship')->nullable();
            $table->string('sponsor_email')->nullable();
            $table->string('sponsor_phone')->nullable();
            $table->text('sponsor_address')->nullable();
            $table->string('sponsor_city')->nullable();
            $table->string('sponsor_preferred')->nullable();
            $table->string('sponsor_preEmail')->nullable();

            $table->string('preparedby')->nullable();
            $table->string('visa')->nullable();
            $table->string('prepared_email')->nullable();
            $table->string('appellant_email')->nullable();

            $table->boolean('authorise')->nullable();
            $table->string('authorise_name')->nullable();

            $table->unsignedBigInteger('form_id')->nullable();
            $table->json('extra_details')->nullable();
            $table->string('unique_code')->nullable();

            $table->unsignedBigInteger('iso_country_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();

            $table->text('address')->nullable();
            $table->string('postal_code')->nullable();

            $table->string('method_decision_received')->nullable();

            // File uploads
            $table->string('refusal_document')->nullable();
            $table->string('appellant_passport')->nullable();
            $table->string('proff_address')->nullable();
            $table->string('refusal_email')->nullable();
            $table->json('additional_document')->nullable();

            $table->text('additional_details')->nullable();
            $table->text('enquiry')->nullable();
            $table->text('notes')->nullable();

            $table->string('status')->nullable();
            $table->string('form_type')->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_inquiries');
    }
};
