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
        Schema::create('template_headers', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('name_si', 50)->nullable();
            $table->unsignedBigInteger('template_category_id')->unsigned()->nullable();
            $table->foreign('template_category_id')->references('id')->on('template_categories');
            $table->unsignedBigInteger('template_type_id')->unsigned()->nullable();
            $table->foreign('template_type_id')->references('id')->on('template_types');
            $table->unsignedBigInteger('template_center_id')->unsigned()->nullable();
            $table->foreign('template_center_id')->references('id')->on('centers');
            $table->boolean('isDisplay')->default(1);
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
        Schema::dropIfExists('template_headers');
    }
};
