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
            $table->dropColumn('pick_up_time');
            $table->dropColumn('pick_up_date');
            $table->dropColumn('return_time');
            $table->dropColumn('return_date');
            $table->dateTime('pick_up_datetime');
            $table->dateTime('return_datetime');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('pick_up_time');
            $table->dropColumn('pick_up_date');
            $table->dropColumn('return_time');
            $table->dropColumn('return_date');
            $table->dropColumn('pick_up_datetime');
            $table->dropColumn('return_datetime');
        });
    }
};
