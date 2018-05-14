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
      'email' => 'brianrainer5497@gmail.com',
      'password' => bcrypt('randomwordsexchanged*<3'),
      'user_phone_number' => '081259262477',
      'index_number' => '05111540000061',
    ]);
    $user->setRole('super_admin');

    $user = User::create([
      'user_name' => 'William Budi Jiewanda',
      'email' => 'wilbudewa2@gmail.com',
      'password' => bcrypt('wibutingkatdewa@4444'),
      'index_number' => '05111540000063',
    ]);
    $user->setRole('super_admin');


    $user = User::create([
      'user_name' => 'Random Dude',
      'email' => 'random@gmail.com',
      'password' => bcrypt('password'),
      'index_number' => '05111x40000xxx',
    ]);
    $user->setRole('normal_user');
  }
}