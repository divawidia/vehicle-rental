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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->string('pick_up_loc');
            $table->dateTime('pick_up_datetime');
            $table->dateTime('return_datetime');
            $table->string('return_loc');
            $table->enum('insurance', ['include', 'not include'])->default('not include');
            $table->enum('first_aid_kit', ['include', 'not include'])->default('not include');
            $table->enum('phone_holder', ['include', 'not include'])->default('not include');
            $table->enum('raincoat', ['include', 'not include'])->default('not include');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('no_hp_wa');
            $table->string('email');
            $table->string('instagram');
            $table->string('facebook');
            $table->string('country');
            $table->string('home_address');
            $table->string('hotel_booking_name');
            $table->string('room_number');
            $table->text('note')->nullable();
            $table->integer('helmet');
            $table->enum('transaction_type', ['COD', 'Transfer'])->nullable();
            $table->string('transaction_code')->nullable();
            $table->enum('shipping_status', ['Sudah', 'Belum'])->default('Belum');
            $table->enum('return_status', ['Sudah', 'Belum'])->default('Belum');
            $table->enum('transaction_status', ['Sudah Dibayar', 'Belum Dibayar', 'Batal'])->default('Belum Dibayar');
            $table->enum('rent_status', ['Selesai', 'Dibooking','Disewa', 'Batal'])->default('Dibooking')->nullable();
            $table->integer('insurance_price');
            $table->integer('shipping_price');
            $table->integer('booking_price');
            $table->integer('total_price');
            $table->integer('total_fine')->default(0);
            $table->integer('start_km_vehicle')->nullable();
            $table->integer('return_km_vehicle')->nullable();
            $table->integer('total_km_rent')->nullable();
            $table->string('vehicle_license_plate');
            $table->integer('total_days_rent');
            $table->integer('month_rent')->nullable();
            $table->integer('monthly_rent_price')->nullable();
            $table->integer('week_rent')->nullable();
            $table->integer('weekly_rent_price')->nullable();
            $table->integer('day_rent')->nullable();
            $table->integer('daily_rent_price')->nullable();
            $table->decimal('latitude_pickup', 10, 8)->nullable();
            $table->decimal('longitude_pickup', 11, 8)->nullable();
            $table->decimal('latitude_return', 10, 8)->nullable();
            $table->decimal('longitude_return', 11, 8)->nullable();
            $table->integer('collection_price')->nullable();
            $table->decimal('distance_pickup')->nullable();
            $table->decimal('rounded_distance_pickup')->nullable();
            $table->decimal('distance_return')->nullable();
            $table->decimal('rounded_distance_return')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
