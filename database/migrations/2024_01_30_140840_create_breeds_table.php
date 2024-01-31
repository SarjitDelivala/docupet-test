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
        Schema::create('breeds', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('pet_type_id');
            $table->string('name');
            $table->boolean('is_dangerous')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pet_type_id')->on('pet_types')->references('id')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breeds');
    }
};
