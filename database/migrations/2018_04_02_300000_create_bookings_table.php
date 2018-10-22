<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{

    protected $waiting_booking_status_id = 1;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('nrp_nip');
            $table->string('email');
            $table->string('phone_number');
            $table->integer('agency_id')->unsigned();
            $table->string('event_title');
            $table->string('event_description', 255);
            $table->integer('category_id')->unsigned();
            $table->integer('booking_status_id')->unsigned()->default($this->waiting_booking_status_id);
            $table->string('poster_imagepath')->nullable();

            $table->string('pic_name_1');
            $table->string('pic_title_1');

            $table->string('pic_name_2')->nullable();
            $table->string('pic_title_2')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade');

            $table->foreign('agency_id')
                ->references('id')
                ->on('agencies')
                ->onUpdate('cascade');
                
            $table->foreign('booking_status_id')
                ->references('id')
                ->on('booking_statuses')
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
        Schema::dropIfExists('bookings');
    }
}
