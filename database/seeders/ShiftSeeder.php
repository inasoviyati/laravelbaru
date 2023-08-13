<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Shift::truncate();
        Schema::enableForeignKeyConstraints();

        $time = [
            ['09:30', '11:30'],
            ['11:30', '13:30'],
            ['13:30', '15:30'],
            ['15:30', '17:30'],
            ['18:30', '20:30'],
        ];

        for ($i = 0; $i < 5; $i++) {
            Shift::create([
                'name' => 'Shift - ' . ($i + 1),
                'time_start' => $time[$i][0],
                'time_end' => $time[$i][1],
            ]);
        }
    }
}
