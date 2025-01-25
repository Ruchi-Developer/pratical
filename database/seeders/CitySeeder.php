<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::insert([
            ['name' => 'Bhopal', 'state_id' => 1],
            ['name' => 'Indore', 'state_id' => 1],
            ['name' => 'Los Angeles', 'state_id' => 2],
        ]);
    }
}
