<?php

use Illuminate\Database\Seeder;
use App\Agency;

class AgencySeeder extends Seeder
{
  /**
   * Run Database Seeder
   * @return void
   */
  public function run(){
    Agency::create([
      'agency_name' => 'Dosen',
    ]);
    Agency::create([
      'agency_name' => 'HMTC',
    ]);
    Agency::create([
      'agency_name' => 'BSO',
    ]);
    Agency::create([
      'agency_name' => 'UKM / Club',
    ]);
    Agency::create([
      'agency_name' => 'BEM FTIK',
    ]);
    Agency::create([
      'agency_name' => 'BEM ITS',
    ]);
    Agency::create([
      'agency_name' => 'Organisasi Lain',
    ]);
    Agency::create([
      'agency_name' => 'Alumni',
    ]);
  }
}