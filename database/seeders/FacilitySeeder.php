<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Facility::truncate();
        Schema::enableForeignKeyConstraints();

        $subjects = [
            ['description' => 'Laboratorium SI MI Dasar', 'name' => 'Lab SI MI Dasar'],
            ['description' => 'Laboratorium SI MI Lanjut', 'name' => 'Lab SI MI Lanjut'],
        ];

        foreach ($subjects as $key => $subject) {
            Facility::create([
                'name' => $subjects[$key]['name'],
                'description' => $subjects[$key]['description']
            ]);
        }
    }
}
