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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_type_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('transmission_id');
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('vehicle_brands')->onDelete('cascade');
            $table->foreign('transmission_id')->references('id')->on('transmissions')->onDelete('cascade');
            $table->string('vehicle_name');
            $table->string('slug');
            $table->text('description');
            $table->text('features');
            $table->string('body');
            $table->integer('passenger');
            $table->integer('fuel_capacity');
            $table->string('fuel_type');
            $table->integer('engine_capacity');
            $table->integer('fuel_economy');
            $table->year('year');
            $table->string('color');
            $table->integer('daily_price');
            $table->integer('weekly_price')->nullable();
            $table->integer('monthly_price');
            $table->integer('unit_quantity');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
