<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutinesTable extends Migration
{
  public function up()
  {
    Schema::create('routines', function(Blueprint $table){
      $table->increments('id');
      $table->string('routine_name');
      $table->integer('repeat_in_sec')->unsigned();
    });
  }

  public function down()
  {
    Schema::dropIfExists('routines');
  }
}