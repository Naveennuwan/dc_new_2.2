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
        Schema::create('centers', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->nullable();
            $table->string('name_sin',50)->nullable();
            $table->string('address_01',60)->nullable();
            $table->string('address_01_sin',60)->nullable();
            $table->string('address_02',60)->nullable();
            $table->string('address_02_sin',60)->nullable();
            $table->string('contact_no',15)->nullable();
            $table->string('week_days',30)->nullable();
            $table->string('week_days_sin',30)->nullable();
            $table->string('week_day_service_time',30)->nullable();
            $table->string('week_day_service_time_sin',30)->nullable();
            $table->string('week_ends',30)->nullable();
            $table->string('week_ends_sin',30)->nullable();
            $table->string('week_ends_service_time',30)->nullable();
            $table->string('week_ends_service_time_sin',30)->nullable();
            $table->boolean('isDisplay')->default(1)->nullable();
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
        Schema::dropIfExists('centers');
    }
};
