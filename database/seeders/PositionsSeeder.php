<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Positions;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            ['position' => 'Portero', 'abreviation' => 'PT'],
            ['position' => 'Defensa entral', 'abreviation' => 'DFC'],
            ['position' => 'Lateral izquierdo', 'abreviation' => 'LI'],
            ['position' => 'Lateral derecho', 'abreviation' => 'LD'],
            ['position' => 'Mediocampista defensivo', 'abreviation' => 'MCD'],
            ['position' => 'Mediocampista', 'abreviation' => 'MC'],
            ['position' => 'Mediocampista ofensivo', 'abreviation' => 'MCO'],
            ['position' => 'Extremo izquierdo', 'abreviation' => 'EI'],
            ['position' => 'Extremo derecho', 'abreviation' => 'ED'],
            ['position' => 'Segundo delantero', 'abreviation' => 'SD'],
            ['position' => 'Delantero centro', 'abreviation' => 'DC'],
        ];

        foreach($positions as $pos){
            Positions::create($pos);
        }
    }
}
