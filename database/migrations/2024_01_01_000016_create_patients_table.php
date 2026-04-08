<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('patient_register_id')->nullable();
            $table->string('patient_nic_no', 20)->nullable();
            $table->string('patient_incharge',100)->nullable();
            $table->string('patient_address',300)->nullable();
            $table->string('patient_contact_no',15)->nullable();
            $table->string('patient_gender',6)->nullable();
            $table->integer('patient_age')->nullable();
            $table->unsignedBigInteger('patient_type_id')->nullable();
            $table->foreign('patient_type_id')->references('id')->on('patient_types');
            $table->unsignedBigInteger('orthodontice_plan_id')->unsigned()->nullable();
            $table->foreign('orthodontice_plan_id')->references('id')->on('orthodontic_plans');
            $table->unsignedBigInteger('patient_center_id')->nullable();
            $table->foreign('patient_center_id')->references('id')->on('centers');
            $table->unsignedBigInteger('parent_patient_id')->unsigned()->nullable();
            $table->foreign('parent_patient_id')->references('id')->on('patients');
            $table->boolean('isDisplay')->default(0);
            $table->unsignedBigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
