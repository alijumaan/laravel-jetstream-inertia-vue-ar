<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_role_crud_by_admin_is_working()
    {
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'Access role']);

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get('roles');
        $response->assertOk();

        $response = $this->actingAs($admin)->post('roles', [
            'name' => 'supervisor',
            'permissions' => $role->syncPermissions($permission)
        ]);
        $response->assertRedirect('roles');

        $role = Role::find($role->id)->first();
        $response = $this->actingAs($admin)->put('roles/' . $role->id, [
            'name' => 'supervisor plus',
            'permissions' => $role->syncPermissions($permission)
        ]);
        $response->assertRedirect('roles');

        $this->assertDatabaseHas(Role::class, ['name' => 'supervisor plus']);

        $response = $this->actingAs($admin)->delete('roles/' . $role->id);
        $response->assertRedirect('roles');

        $this->assertDatabaseMissing(Role::class, ['name' => 'supervisor plus']);
    }
}
