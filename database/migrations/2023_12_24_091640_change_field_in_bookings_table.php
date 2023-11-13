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
            $table->integer('month_rent')->change();
            $table->integer('monthly_rent_price')->change();
            $table->integer('week_rent')->change();
            $table->integer('weekly_rent_price')->change();
            $table->integer('day_rent')->change();
            $table->integer('daily_rent_price')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('month_rent')->nullable();
            $table->dropColumn('monthly_rent_price')->nullable();
            $table->dropColumn('week_rent')->nullable();
            $table->dropColumn('weekly_rent_price')->nullable();
            $table->dropColumn('day_rent')->nullable();
            $table->dropColumn('daily_rent_price')->nullable();
        });
    }
};
