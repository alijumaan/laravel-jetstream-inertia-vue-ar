<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PeriodSeeder::class);
        $this->call(BuildingSeeder::class);
        $this->call(ExtinguisherSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(ItemsTableSeeder::class);
    }
}
