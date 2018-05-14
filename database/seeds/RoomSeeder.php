<?php

use Illuminate\Database\Seeder;
use App\Room;

class RoomSeeder extends Seeder
{
  /**
   * Run Database Seeder
   * @return void
   */
  public function run(){
    $room_name = 'Ruang Kelas IF-';

    for ($i=101; $i < 316; $i++) { 
      Room::create([
        'room_code' => 'IF-'.$i,
        'room_name' => $room_name.$i,
      ]);

      if ($i%100 == 15) {
        $i = $i + 100;
        $i = $i - 15;
        if ($i >= 300){
          $room_name = 'Laboratorium ';
        }
      }

    }
  }
}