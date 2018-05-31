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
      'agency_name' => 'Mahasiswa (Perseorangan)',
    ]);
    Agency::create([
      'agency_name' => 'BSO',
    ]);
    Agency::create([
      'agency_name' => 'HMTC',
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
      'agency_name' => 'Dosen / Karyawan',
    ]);
    Agency::create([
      'agency_name' => 'Alumni',
    ]);
    Agency::create([
      'agency_name' => 'Perusahaan / Start-Up',
    ]);
    Agency::create([
      'agency_name' => 'Non-Profit Organization',
    ]);
  }
}