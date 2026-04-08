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
        Schema::create('template_bodies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('template_id')->unsigned()->nullable();
            $table->foreign('template_id')->references('id')->on('template_headers');
            $table->unsignedBigInteger('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('dose',50)->nullable();
            $table->unsignedBigInteger('frequency_id')->unsigned()->nullable();
            $table->foreign('frequency_id')->references('id')->on('drug_frequencies');
            $table->string('duration',50)->nullable();
            $table->decimal('quantity', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_bodies');
    }
};
