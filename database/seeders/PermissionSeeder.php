<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Rest cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'Access user',
            'Show user',
            'Create user',
            'Edit user',
            'Delete user',
            'Restore user',
            'Force delete user',
            'Access preventative',
            'Show preventative',
            'Create preventative',
            'Edit preventative',
            'Delete preventative',
            'Restore preventative',
            'Force delete preventative',
            'Access supply',
            'Show supply',
            'Create supply',
            'Edit supply',
            'Delete supply',
            'Restore supply',
            'Force delete supply',
            'Access building',
            'Show building',
            'Create building',
            'Edit building',
            'Delete building',
            'Restore building',
            'Force delete building',
            'Access extinguisher',
            'Show extinguisher',
            'Create extinguisher',
            'Edit extinguisher',
            'Delete extinguisher',
            'Restore extinguisher',
            'Force delete extinguisher',
            'Access item',
            'Show item',
            'Create item',
            'Edit item',
            'Delete item',
            'Restore item',
            'Force delete item',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
