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
            $table->integer('vehicle_id');
            $table->string('pick_up_loc');
            $table->date('pick_up_date');
            $table->time('pick_up_time');
            $table->string('return_loc');
            $table->date('return_date');
            $table->time('return_time');
            $table->string('insurance');
            $table->string('first_aid_kit');
            $table->string('phone_holder');
            $table->string('raincoat');
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
            $table->text('note');
            $table->integer('helmet');
            $table->string('transaction_type');
            $table->string('transaction_status');
            $table->string('transaction_code');
            $table->string('shipping_status');
            $table->string('return_status');
            $table->integer('insurance_price');
            $table->integer('shipping_price');
            $table->integer('booking_price');
            $table->integer('total_price');
            $table->integer('total_fine');
            $table->integer('start_km_vehicle');
            $table->integer('return_km_vehicle');
            $table->integer('total_km_rent');
            $table->string('vehicle_license_plate');
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
