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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('appointment_no')->nullable();

            $table->unsignedBigInteger('patient_id')->unsigned()->nullable();
            $table->foreign('patient_id')->references('id')->on('patients');

            $table->string('name')->nullable();
            $table->string('contact_no',15)->nullable();

            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors');

            $table->unsignedBigInteger('patient_type_id');
            $table->foreign('patient_type_id')->references('id')->on('patient_types');

            $table->unsignedBigInteger('center_id');
            $table->foreign('center_id')->references('id')->on('centers');
            
            $table->date('appointment_date');
            $table->time('appointment_time')->nullable();
            
            $table->enum('remark', [
                'next_visit',
                'on_call',
                'riception'
            ])->default('riception');

            $table->enum('status', [
                'pending',
                'confirmed',
                'completed',
                'cancelled'
            ])->default('pending');
            
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
