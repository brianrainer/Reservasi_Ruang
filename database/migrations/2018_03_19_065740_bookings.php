<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::dropIfExists('bookings');
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('booking_id');
            $table->string('name');
            $table->string('phone_number');
            $table->string('email');
            $table->json('room');
            $table->string('agency');
            //$table->string('start');
            //$table->string('end');
            $table->integer('routine');
            $table->string('category');
            $table->string('event_desc');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
