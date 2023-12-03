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
            $table->date('pick_up_date')->nullable()->change();
            $table->date('return_date')->nullable()->change();
            $table->time('pick_up_time')->nullable();
            $table->time('return_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->datetime('pick_up_datetime')->nullable()->change();
            $table->datetime('return_datetime')->nullable()->change();
            $table->dropColumn('pick_up_time')->nullable();
            $table->dropColumn('return_time')->nullable();
        });
    }
};
