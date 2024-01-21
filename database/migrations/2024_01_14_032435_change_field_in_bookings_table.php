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
            $table->decimal('latitude_pickup', 10, 8)->nullable()->change();
            $table->decimal('longitude_pickup', 11, 8)->nullable()->change();
            $table->decimal('latitude_return', 10, 8)->nullable()->change();
            $table->decimal('longitude_return', 11, 8)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->float('latitude_pickup')->nullable()->change();
            $table->float('longitude_pickup')->nullable()->change();
            $table->float('latitude_return')->nullable()->change();
            $table->float('longitude_return')->nullable()->change();
        });
    }
};
