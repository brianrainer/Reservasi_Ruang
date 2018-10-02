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
      'agency_name' => 'Mahasiswa/Individu',
    ]);
    // Agency::create([
    //   'agency_name' => 'BSO',
    // ]);
    Agency::create([
      'agency_name' => 'Himpunan',
    ]);
    Agency::create([
      'agency_name' => 'BEM',
    ]);
    // Agency::create([
    //   'agency_name' => 'UKM / Club',
    // ]);
    Agency::create([
      'agency_name' => 'Departemen',
    ]);
    Agency::create([
      'agency_name' => 'Fakultas',
    ]);
    Agency::create([
      'agency_name' => 'ITS',
    ]);
    // Agency::create([
    //   'agency_name' => 'Dosen/Karyawan',
    // ]);
    // Agency::create([
    //   'agency_name' => 'Alumni',
    // ]);
    // Agency::create([
    //   'agency_name' => 'Perusahaan',
    // ]);
    Agency::create([
      'agency_name' => 'Lainnya',
    ]);
  }
}