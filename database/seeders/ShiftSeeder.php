<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aliases = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $time = [
            ['09:30', '11:30'],
            ['11:30', '13:30'],
            ['13:30', '15:30'],
            ['15:30', '17:30'],
            ['18:30', '20:30']
        ];
        foreach ($aliases as $key => $alias) {
            for ($i = 0; $i < 5; $i++) {
                Shift::create([
                    'name' => $alias . ' - ' . ($i + 1),
                    'day' => ($key + 1),
                    'time_start' => $time[$i][0],
                    'time_end' => $time[$i][1],
                ]);
            }
        }
    }
}
