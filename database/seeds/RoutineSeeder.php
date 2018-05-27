<?php

use Illuminate\Database\Seeder;
use App\Routine;

class RoutineSeeder extends Seeder
{
  public function run(){
    Routine::create([
      'routine_name' => 'Daily',
      'repeat_in_sec' => 1 * 24 * 60 * 60,
    ]);
    Routine::create([
      'routine_name' => 'BiDaily',
      'repeat_in_sec' => 2 * 24 * 60 * 60,
    ]);
    Routine::create([
      'routine_name' => 'TriDaily',
      'repeat_in_sec' => 3 * 24 * 60 * 60,
    ]);
    Routine::create([
      'routine_name' => 'Weekly',
      'repeat_in_sec' => 1 * 7 * 24 * 60 * 60,
    ]);
    Routine::create([
      'routine_name' => 'BiWeekly',
      'repeat_in_sec' => 2 * 7 * 24 * 60 * 60,
    ]);
    Routine::create([
      'routine_name' => 'TriWeekly',
      'repeat_in_sec' => 3 * 7 * 24 * 60 * 60,
    ]);
    Routine::create([
      'routine_name' => 'Monthly',
      'repeat_in_sec' => 1 * 4 * 7 * 24 * 60 * 60,
    ]);
    // Routine::create([
    //   'routine_name' => 'BiMonthly',
    //   'repeat_in_sec' => 2 * 4 * 7 * 24 * 60 * 60,
    // ]);
    // Routine::create([
    //   'routine_name' => 'TriMonthly',
    //   'repeat_in_sec' => 3 * 4 * 7 * 24 * 60 * 60,
    // ]);
    // Routine::create([
    //   'routine_name' => 'Quarterly',
    //   'repeat_in_sec' => 4 * 4 * 7 * 24 * 60 * 60,
    // ]);
    // Routine::create([
    //   'routine_name' => 'Semi-Anually',
    //   'repeat_in_sec' => 6 * 4 * 7 * 24 * 60 * 60,
    // ]);
    // Routine::create([
    //   'routine_name' => 'Annually',
    //   'repeat_in_sec' => 12 * 4 * 7 * 24 * 60 * 60,
    // ]);
  }

}