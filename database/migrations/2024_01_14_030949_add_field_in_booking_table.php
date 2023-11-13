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
            $table->float('latitude_pickup')->nullable();
            $table->float('longitude_pickup')->nullable();
            $table->float('latitude_return')->nullable();
            $table->float('longitude_return')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('latitude_pickup');
            $table->dropColumn('longitude_pickup');
            $table->dropColumn('latitude_return');
            $table->dropColumn('longitude_return');
        });
    }
};
