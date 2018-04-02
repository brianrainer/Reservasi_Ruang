<?php

use Illuminate\Database\Seeder;

class BooklistDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) { 
          DB::table('bookings')->insert([
            'name' => 'yuuta'.$i,
            'phone_number' => '081'.$i,
            'email' => 'y@y.y',
            'room' => 'LP305',
            'start' => new DateTime(),
            'duration' => 120,
            'event_title' => 'lp'.$i,
            'event_desc' => 'dummy event at '.$i,
            'agencies' => 'personal',
            'routine' => 'Daily',
            'howmanytimes' => 1,
            'category' => 'Workshop',
            'accept' => false,
          ]);
        }
    }
}
