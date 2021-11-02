<?php

namespace Database\Seeders;

use App\Models\Extinguisher;
use Illuminate\Database\Seeder;

class ExtinguisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Extinguisher::create([
            'type' => 'ماء',
            'slug' => 'ماء',
        ]);

        Extinguisher::create([
            'type' => 'رغوة',
            'slug' => 'رغوة',
        ]);

        Extinguisher::create([
            'type' => 'بودرة',
            'slug' => 'بودرة',
        ]);

        Extinguisher::create([
            'type' => 'ثاني اكسيد الكربون',
            'slug' => 'ثاني-اكسيد-الكربون',
        ]);
    }
}
