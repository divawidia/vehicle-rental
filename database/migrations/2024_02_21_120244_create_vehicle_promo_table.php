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
        Schema::create('vehicle_promo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('promo_id');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('promo_id')->references('id')->on('promos')->onDelete('cascade');;
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_promo');
    }
};
