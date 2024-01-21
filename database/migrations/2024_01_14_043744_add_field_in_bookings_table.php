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
        Schema::table('bookings', function (Blueprint $table) {
            $table->integer('collection_price')->nullable();
            $table->decimal('distance_pickup')->nullable();
            $table->decimal('rounded_distance_pickup')->nullable();
            $table->decimal('distance_return')->nullable();
            $table->decimal('rounded_distance_return')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('collection_price')->nullable();
            $table->dropColumn('distance_pickup')->nullable();
            $table->dropColumn('rounded_distance_pickup')->nullable();
            $table->dropColumn('distance_return')->nullable();
            $table->dropColumn('rounded_distance_return')->nullable();
        });
    }
};
