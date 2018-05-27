<?php

use Illuminate\Database\Seeder;
use App\Booking;
use App\BookingDetail;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $booking = Booking::create([
        'name' => 'Brian Rainer',
        'email' => 'brianrainer5497@gmail.com',
        'phone_number' => '081259262477',
        'agency_id' => '1',
        'event_title' => 'Kuliah Pengganti PAA F',
        'event_description' => 'Kelas Pengganti untuk Pertemuan ke-10 Kelas PAA F oleh Pak XX',
        'category_id' => '1',
      ]);

      BookingDetail::create([
        'booking_id' => $booking->id,
        'room_id' => '1',
        'event_start' => date('2018-06-01 10:00:00'),
        'event_end' => date('2018-06-01 12:30:00'),
        'booking_status_id' => '1',
      ]);
    }
}
