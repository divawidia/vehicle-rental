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
            $table->enum('pickup_location_type', ['office', 'hotel_villa', 'custom_address']);
            $table->enum('return_location_type', ['office', 'hotel_villa', 'custom_address']);
            $table->string('pick_up_loc')->nullable()->change();
            $table->string('return_loc')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('pickup_location_type', ['office', 'hotel_villa', 'custom_address']);
            $table->dropColumn('return_location_type', ['office', 'hotel_villa', 'custom_address']);
            $table->string('pick_up_loc')->change();
            $table->string('return_loc')->change();
        });
    }
};
