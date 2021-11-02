<?php

namespace Database\Seeders;

use App\Models\Building;
use App\Models\BuildingExtinguisher;
use App\Models\Extinguisher;
use Illuminate\Database\Seeder;

class BuildingExtinguisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BuildingExtinguisher::create([
            'building_id' => Building::all()->random()->id,
            'extinguisher_id' => Extinguisher::all()->random()->id,
        ]);
    }
}
