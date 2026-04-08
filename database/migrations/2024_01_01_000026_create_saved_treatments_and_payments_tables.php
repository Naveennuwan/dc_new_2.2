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
        // First, create the new treatments table without the payment field
        Schema::create('saved_treatments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('patients');

            $table->unsignedBigInteger('template_id')->nullable();
            $table->foreign('template_id')->references('id')->on('template_headers');

            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id')->references('id')->on('doctors');

            $table->unsignedBigInteger('center_id')->nullable();
            $table->foreign('center_id')->references('id')->on('centers');

            $table->boolean('isSettled')->default(false);
            $table->boolean('isPrint')->default(false);
            
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');

            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            
            $table->timestamps();
            $table->softDeletes();
        });

        // Create the payments table
        Schema::create('saved_treatments_payments', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('template_id')->nullable();
            $table->foreign('template_id')
                  ->references('id')
                  ->on('saved_treatments')
                  ->onDelete('cascade');
            
            $table->decimal('payment', 8, 2)->default(0);
            
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');

            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_treatments_payments');
        Schema::dropIfExists('saved_treatments');
    }
};
