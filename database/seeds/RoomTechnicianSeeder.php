<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Room;

class RoomTechnicianSeeder extends Seeder
{
  public function run (){
    $rooms = Room::all();
    $user = User::first();

    foreach ($rooms as $room) {
      
    }
  }
}