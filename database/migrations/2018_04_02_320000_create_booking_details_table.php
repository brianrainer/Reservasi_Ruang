<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->timestamp('event_start')->nullable();
            $table->timestamp('event_end')->nullable();
            $table->integer('booking_status_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('booking_id')
                ->references('id')
                ->on('bookings')
                ->onUpdate('cascade');

            $table->foreign('booking_status_id')
                ->references('id')
                ->on('booking_statuses')
                ->onUpdate('cascade');

            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_details');
    }
}
