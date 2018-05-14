<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
  /**
   * Run Database Seeder
   * @return void
   */
  public function run(){
    $tables = array('user', 'role', 'room', 'agency', 'category', 'booking_status', 'booking', 'booking_time');
    $roles = array('edit', 'create', 'delete');

    foreach ($tables as $key_table => $value_table) {
      foreach ($roles as $key_role => $value_role) {
        Role::create([
          'role_name' => $value_role.'_'.$value_table,
        ]);
      }
    }

    Role::create([
      'role_name' => 'accept_booking'
    ]);
    Role::create([
      'role_name' => 'cancel_booking'
    ]);
    Role::create([
      'role_name' => 'reject_booking'
    ]);

  }
}