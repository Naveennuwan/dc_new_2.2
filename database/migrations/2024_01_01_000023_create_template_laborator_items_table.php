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
        Schema::create('template_laborator_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('template_id')->unsigned()->nullable();
            $table->foreign('template_id')->references('id')->on('template_headers');
            $table->unsignedBigInteger('laboratory_id')->unsigned()->nullable();
            $table->foreign('laboratory_id')->references('id')->on('laboratory_expenses');
            $table->decimal('quantity', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_laborator_items');
    }
};
