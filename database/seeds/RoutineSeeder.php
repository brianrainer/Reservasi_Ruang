<?php

use Illuminate\Database\Seeder;
use App\Routine;

class RoutineSeeder extends Seeder
{
  public function run(){
    Routine::create([
      'routine_name' => 'Daily / Per Hari',
      'repeat_in_sec' => 1 * 24 * 60 * 60,
    ]);
    Routine::create([
      'routine_name' => 'BiDaily / Per Dua Hari',
      'repeat_in_sec' => 2 * 24 * 60 * 60,
    ]);
    Routine::create([
      'routine_name' => 'TriDaily / Per Tiga Hari',
      'repeat_in_sec' => 3 * 24 * 60 * 60,
    ]);
    Routine::create([
      'routine_name' => 'Weekly / Per Minggu',
      'repeat_in_sec' => 1 * 7 * 24 * 60 * 60,
    ]);
    Routine::create([
      'routine_name' => 'BiWeekly / Per Dua Minggu',
      'repeat_in_sec' => 2 * 7 * 24 * 60 * 60,
    ]);
    Routine::create([
      'routine_name' => 'TriWeekly / Per Tiga Minggu',
      'repeat_in_sec' => 3 * 7 * 24 * 60 * 60,
    ]);
    Routine::create([
      'routine_name' => 'Monthly / Per Bulan',
      'repeat_in_sec' => 1 * 4 * 7 * 24 * 60 * 60,
    ]);
    Routine::create([
      'routine_name' => 'BiMonthly / Per Dua Bulan',
      'repeat_in_sec' => 2 * 4 * 7 * 24 * 60 * 60,
    ]);
    Routine::create([
      'routine_name' => 'TriMonthly / Per Tiga Bulan',
      'repeat_in_sec' => 3 * 4 * 7 * 24 * 60 * 60,
    ]);
    Routine::create([
      'routine_name' => 'Quarterly / Per Empat Bulan',
      'repeat_in_sec' => 4 * 4 * 7 * 24 * 60 * 60,
    ]);
    Routine::create([
      'routine_name' => 'Semi-Anually / Per Enam Bulan',
      'repeat_in_sec' => 6 * 4 * 7 * 24 * 60 * 60,
    ]);
    Routine::create([
      'routine_name' => 'Annually / Per Tahun',
      'repeat_in_sec' => 12 * 4 * 7 * 24 * 60 * 60,
    ]);
  }

}