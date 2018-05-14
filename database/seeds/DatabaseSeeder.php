<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            RoomSeeder::class,
            BookingStatusSeeder::class,
            AgencySeeder::class,
            CategorySeeder::class,
            UserSeeder::class,
        ]);
    }
}
