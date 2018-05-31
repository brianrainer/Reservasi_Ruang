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
        'nrp_nip' => '5115100061',
        'email' => 'brianrainer5497@gmail.com',
        'phone_number' => '081259262477',
        'agency_id' => '1',
        'event_title' => 'Kuliah Pengganti PAA F',
        'event_description' => 'Kelas Pengganti untuk Pertemuan ke-10 Kelas PAA F oleh Pak XX',
        'category_id' => '1',
      ]);

      for ($i=1; $i < 2; $i++) { 
        for ($j=1; $j < 3; $j++) { 
          BookingDetail::create([
            'booking_id' => $booking->id,
            'room_id' => $i,
            'event_start' => date('2018-06-0'.$j.' 10:00:00'),
            'event_end' => date('2018-06-0'.$j.' 12:30:00'),
            'booking_status_id' => '1',
          ]);
        }
      }

      $booking = Booking::create([
        'name' => 'William Budi',
        'nrp_nip' => '5115100063',
        'email' => 'wilbudewa2@gmail.com',
        'phone_number' => '081222333444',
        'agency_id' => '1',
        'event_title' => 'Pelatihan LKMM TD FTIK XV',
        'event_description' => 'LKMM TD FTIK XV dengan tema "Bangkit!"  adalah pelatihan yang diperlukan bla bla bla',
        'category_id' => '1',
      ]);

      for ($i=1; $i < 6; $i++) { 
        for ($j=4; $j < 9; $j++) { 
          BookingDetail::create([
            'booking_id' => $booking->id,
            'room_id' => $i,
            'event_start' => date('2018-06-0'.$j.' 16:00:00'),
            'event_end' => date('2018-06-0'.$j.' 21:30:00'),
            'booking_status_id' => '1',
          ]);
        }
      }
    }
}
