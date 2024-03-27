<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Player;
use App\Models\Positions;
use Illuminate\Support\Arr;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = Positions::all();
        $positionsPlucked = $positions->pluck('abreviation');

        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 25; $i++) {
            Player::create([
                'name' => $faker->name,
                'last_name' => $faker->lastName,
                'age' => rand(18, 34),
                'nationality' => $faker->country,
                'position' => Arr::random($positionsPlucked->all()),
                'image' => null,
            ]);
        }
    }
}
