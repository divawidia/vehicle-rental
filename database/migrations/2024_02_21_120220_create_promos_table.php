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
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string( 'code' )->nullable();
            $table->string( 'name' );

            // The description of the voucher - Not necessary
            $table->text( 'description')->nullable( );

            $table->enum('type', ['voucher', 'sale']);

            // The number of uses currently
            $table->integer( 'uses')->unsigned( )->nullable( );

            // The max uses this voucher has
            $table->integer( 'max_uses')->unsigned()->nullable( );

            // The amount to discount by (in pennies) in this example.
            $table->integer( 'discount_amount' );

            // When the voucher begins
            $table->timestamp( 'starts_at' );

            // When the voucher ends
            $table->timestamp( 'expires_at' );

            // You know what this is...
            $table->timestamps( );

            // We like to horde data.
            $table->softDeletes( );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
