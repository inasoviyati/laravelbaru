<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($year = 1; $year <= 5; $year++) {
            for ($order = 1; $order <= rand(1, 9); $order++) {
                Room::create([
                    'name' => "{$year}0{$order}",
                ]);
            }
        }
    }
}
