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
            $table->enum('insurance', ['include', 'not include'])->default('not include')->change();
            $table->enum('first_aid_kit', ['include', 'not include'])->default('not include')->change();
            $table->enum('phone_holder', ['include', 'not include'])->default('not include')->change();
            $table->enum('raincoat', ['include', 'not include'])->default('not include')->change();
            $table->enum('transaction_type', ['COD', 'Transfer'])->nullable()->change();
            $table->enum('transaction_status', ['Sudah Dibayar', 'Belum Dibayar'])->default('Belum Dibayar')->change();
            $table->string('transaction_code')->nullable()->change();
            $table->enum('shipping_status', ['Sudah', 'Belum'])->default('Belum')->change();
            $table->enum('return_status', ['Sudah', 'Belum'])->default('Belum')->change();
            $table->integer('total_fine')->default(0)->change();
            $table->integer('start_km_vehicle')->nullable()->change();
            $table->integer('return_km_vehicle')->nullable()->change();
            $table->integer('total_km_rent')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('insurance', ['include', 'not include'])->default('not include');
            $table->dropColumn('first_aid_kit', ['include', 'not include'])->default('not include');
            $table->dropColumn('phone_holder', ['include', 'not include'])->default('not include');
            $table->dropColumn('raincoat', ['include', 'not include'])->default('not include');
            $table->dropColumn('transaction_type', ['COD', 'Transfer'])->nullable();
            $table->dropColumn('transaction_status', ['Sudah Dibayar', 'Belum Dibayar'])->default('Belum Dibayar');
            $table->dropColumn('transaction_code')->nullable();
            $table->dropColumn('shipping_status', ['Sudah', 'Belum'])->default('Belum');
            $table->dropColumn('return_status', ['Sudah', 'Belum'])->default('Belum');
            $table->dropColumn('total_fine')->default(0);
            $table->dropColumn('start_km_vehicle')->nullable();
            $table->dropColumn('return_km_vehicle')->nullable();
            $table->dropColumn('total_km_rent')->nullable();
        });
    }
};
