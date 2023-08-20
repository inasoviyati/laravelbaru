<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ShiftSeeder::class,
            RoomSeeder::class,
            SubjectSeeder::class,
            FacilitySeeder::class,
            UserSeeder::class,
        ]);
    }
}
