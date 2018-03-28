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
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('booking_id');
            $table->string('name');
            $table->string('phone_number');
            $table->string('email');
            $table->string('room');
            $table->string('event_desc');
            $table->dateTime('start');
            $table->integer('duration');
            $table->string('agencies');
            $table->string('routine');
            $table->integer('howmanytimes');
            $table->string('category');
            $table->boolean('accept');
            $table->timestamp('created_at')->nullable();

            $table->index(['start','created_at']);


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
        Schema::dropIfExists('bookings');
    }
}
