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
        Schema::create('template_price_levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('template_id')->unsigned()->nullable();
            $table->foreign('template_id')->references('id')->on('template_headers');
            $table->decimal('price', 8, 2);
            $table->date('effective_from');
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_price_levels');
    }
};
