<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        State::insert([
            ['name' => 'Madhya Pradesh', 'country_id' => 1],
            ['name' => 'California', 'country_id' => 2],
        ]);
    }
}
