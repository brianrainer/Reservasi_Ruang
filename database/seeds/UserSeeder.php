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
      'user_name' => 'Brian Rainer Suryaputra',
      'email' => 'brian@gmail.com',
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


    $user = User::create([
      'user_name' => 'Normal User',
      'email' => 'normal@gmail.com',
      'password' => bcrypt('qweqwe'),
      'nrp_nip' => '05111040000999',
    ]);
    $user->setRole('normal_user');
  }
}