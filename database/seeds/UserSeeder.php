<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder {
  /**
   * Run Database Seed
   * @return void
   */
  public function run(){
    $user = User::create([
      'user_name' => 'Jumali',
      'email' => 'jumali.if@gmail.com',
      'password' => bcrypt('password'),
      'user_phone_number' => '081803211009',
    ]);
    $user->setRole('super_admin');

    $user = User::create([
      'user_name' => 'Sukron',
      'email' => 'dhensukron@gmail.com',
      'password' => bcrypt('password'),
      'user_phone_number' => '085101459913',
    ]);
    $user->setRole('super_admin');

    $user = User::create([
      'user_name' => 'Brian Rainer Suryaputra',
      'email' => 'brianrainer5497@gmail.com',
      'password' => bcrypt('qweqwe'),
      'user_phone_number' => '081259262477',
      'nrp_nip' => '05111540000061',
    ]);
    $user->setRole('super_admin');

    $user = User::create([
      'user_name' => 'William Budi Jiewanda',
      'email' => 'wilbudewa2@gmail.com',
      'password' => bcrypt('qweqwe'),
      'nrp_nip' => '05111540000063',
    ]);
    $user->setRole('super_admin');
  }
}