<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SupplyTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_role_can_access_supply_page()
    {
        Role::create(['name' => 'admin']);

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get('supplies');

        $response->assertStatus(200);
    }

    public function test_supply_role_can_access_supplies_page()
    {
        $permission = Permission::create(['name' => 'Access supply']);
        $role = Role::create(['name' => 'supply']);
        $role->givePermissionTo($permission);

        $user = User::factory()->create();
        $user->assignRole('supply');

        $response = $this->actingAs($user)->get('supplies');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('preventatives');
        $response->assertStatus(403);
    }

    public function test_users_can_not_access_supplies_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('supplies');

        $response->assertStatus(403);
    }
}
