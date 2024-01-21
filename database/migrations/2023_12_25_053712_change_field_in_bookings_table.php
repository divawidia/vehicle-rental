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
            $table->enum('transaction_status', ['Sudah Dibayar', 'Belum Dibayar', 'Batal'])->default('Belum Dibayar')->change();
            $table->enum('booking_status', ['Selesai', 'Sedang Jadwal Booking', 'Batal'])->default('Sedang Jadwal Booking')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('transaction_status', ['Sudah Dibayar', 'Belum Dibayar']);
            $table->dropColumn('booking_status', ['Selesai', 'Sedang Jadwal Booking', 'Batal']);
        });
    }
};
