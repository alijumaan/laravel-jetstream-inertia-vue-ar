<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // gets all permissions via Gate::before rule; see AuthServiceProvider
        Role::create(['name' => 'admin']);
        $supervisor = Role::create(['name' => 'supervisor']);
        $supply = Role::create(['name' => 'supply']);
        $inspector = Role::create(['name' => 'inspector']);
        $user = Role::create(['name' => 'user']);

        $supervisorPermissions = [
            'Access preventative',
            'Show preventative',
            'Create preventative',
            'Edit preventative',
            'Delete preventative',
            'Access supply',
            'Show supply',
            'Create supply',
            'Edit supply',
            'Delete supply',
            'Access building',
            'Show building',
            'Create building',
            'Edit building',
            'Delete building',
            'Access extinguisher',
            'Show extinguisher',
            'Create extinguisher',
            'Edit extinguisher',
            'Delete extinguisher',
            'Access item',
            'Show item',
            'Create item',
            'Edit item',
            'Delete item',
        ];

        $inspectorPermissions = [
            'Access preventative',
            'Show preventative',
            'Create preventative',
            'Edit preventative',
            'Delete preventative',
            'Access building',
            'Show building',
            'Create building',
            'Edit building',
            'Delete building',
            'Access extinguisher',
            'Show extinguisher',
            'Create extinguisher',
            'Edit extinguisher',
            'Delete extinguisher'
        ];

        $supplyPermissions = [
            'Access supply',
            'Show supply',
            'Create supply',
            'Edit supply',
            'Delete supply',
            'Access item',
            'Show item',
            'Create item',
            'Edit item',
            'Delete item',
        ];

        $userPermissions = [
            'Access preventative',
            'Access building',
            'Access extinguisher',
            'Access supply',
            'Access item',
        ];

        $supervisor->givePermissionTo($supervisorPermissions);
        $inspector->givePermissionTo($inspectorPermissions);
        $supply->givePermissionTo($supplyPermissions);
        $user->givePermissionTo($userPermissions);
    }
}
