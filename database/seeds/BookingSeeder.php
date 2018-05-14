<?php

use Illuminate\Database\Seeder;
use App\Booking;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /**
      $faker = \Faker\Factory::create();
      $limit = 30;

      for ($i=0; $i < $limit; $i++) { 
        Bookings::create([
          'name' => $faker->name,
          'phone_number' => $faker->phoneNumber,
          'email' => $faker->unique()->email,
          'room' => $faker->numberBetween($min=101, $max=415),
          'start' => $faker->unique()->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d'),
          'duration' => $faker->numberBetween($min = 30, $max = 360),
          'event_title' => $faker->word,
          'event_desc' => $faker->sentence($nbWords = 5, $variableNbWords = true),
          'agencies' => 'Personal',
          'routine' => 'Daily',
          'howmanytimes' => 1,
          'category' => 'Workshop',
          'accept' => false,
        ]);
      }
      */
    }
}
