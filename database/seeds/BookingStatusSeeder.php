<?php

use Illuminate\Database\Seeder;
use App\BookingStatus;

class BookingStatusSeeder extends Seeder
{
  /**
   * Run Database Seeder
   * @return void
   */
  public function run(){
    BookingStatus::create([
      'booking_status_name' => 'MENUNGGU',
    ]);
    BookingStatus::create([
      'booking_status_name' => 'DITERIMA',
    ]);
    BookingStatus::create([
      'booking_status_name' => 'DITOLAK',
    ]);
  }
}