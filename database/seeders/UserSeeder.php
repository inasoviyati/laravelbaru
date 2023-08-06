<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 500; $i++) {
            do {
                $npm = rand(1, 3) . '0' . rand(1, 9) . rand(19, 23) . rand('111', '999');
                $npmCheck = User::where('npm', $npm)->count();
            } while ($npmCheck > 0);

            $faker = Faker::create('id_ID');
            $name = $faker->name;

            do {
                $email = Str::slug(Str::words($name, 2, ''), '_') . rand(1, 99) . '@mailinator.com';
                $emailCheck = User::where('email', $email)->count();
            } while ($emailCheck > 0);

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'email_verified_at' => now(),
                'npm' => $npm,
                'role' => 'student',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => null,
            ]);

            $user->roomUser()->create([
                'student_id' => $user->id,
                'room_id' => Room::inRandomOrder()->first()->id,
            ]);
        }
    }
}
