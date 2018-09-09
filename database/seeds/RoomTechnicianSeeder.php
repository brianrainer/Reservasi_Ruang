<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Room;

class RoomTechnicianSeeder extends Seeder
{
  public function run (){
    $rooms = Room::all();
    $users = User::join('users_roles', 'users_roles.user_id','=','users.id')
      ->join('roles','roles.id','=','users_roles.role_id')
      ->where('roles.role_name','=','manage_room')
      ->select('users.id')
      ->get();

    foreach ($rooms as $room) {
      foreach ($users as $user) {
        $room->addTechnician($user->id);      
      }  
    }
  }
}
