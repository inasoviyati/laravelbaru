<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Subject::truncate();
        Schema::enableForeignKeyConstraints();

        $subjects = [
            ['alias' => 'Web 1', 'name' => 'Pemograman Web 1'],
            ['alias' => 'Web 2', 'name' => 'Pemograman Web 2'],
            ['alias' => 'P 1', 'name' => 'Pemograman Dasar 1'],
            ['alias' => 'P 2', 'name' => 'Pemograman Dasar 2'],
            ['alias' => 'P 3', 'name' => 'Pemograman Dasar 3'],
            ['alias' => 'PBO', 'name' => 'Pemograman Berorientasi Objek'],
            ['alias' => 'PBD', 'name' => 'Pemograman Basis Data'],
            ['alias' => 'KSI', 'name' => 'Konsep Sistem Informasi'],
            ['alias' => 'PTI', 'name' => 'Pengantar Teknologi Informasi'],
            ['alias' => 'MM', 'name' => 'Multimedia']
        ];

        foreach ($subjects as $key => $subject) {
            Subject::create([
                'name' => $subjects[$key]['name'],
                'alias' => $subjects[$key]['alias']
            ]);
        }
    }
}
