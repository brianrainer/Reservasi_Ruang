<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Schedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('schedule_id');
            $table->integer('booking_id');
            $table->integer('room_id');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->timestamp('created_at')->nullable();

            $table->index(['start']);
            // $table->foreign('booking_id')->references('booking_id')->on('bookings');
            // $table->foreign('room_id')->references('room_id')->on('rooms');
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
        Schema::dropIfExists('schedules');
    }
}
