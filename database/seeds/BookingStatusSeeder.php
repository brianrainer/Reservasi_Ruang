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
      'booking_status_name' => 'DITOLAK',
    ]);
    BookingStatus::create([
      'booking_status_name' => 'DIBATALKAN PEMOHON',
    ]);
    BookingStatus::create([
      'booking_status_name' => 'DIBATALKAN TEKNISI',
    ]);
    BookingStatus::create([
      'booking_status_name' => 'DIALIHKAN',
    ]);
    BookingStatus::create([
      'booking_status_name' => 'DITERIMA',
    ]);
  }
}