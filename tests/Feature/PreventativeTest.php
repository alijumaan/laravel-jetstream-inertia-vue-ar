<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PreventativeTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_role_can_access_preventative_page()
    {
        Role::create(['name' => 'admin']);

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get('preventatives');

        $response->assertStatus(200);
    }

    public function test_inspector_role_can_access_preventative_page()
    {
        $permission = Permission::create(['name' => 'Access preventative']);
        $role = Role::create(['name' => 'inspector']);
        $role->givePermissionTo($permission);

        $user = User::factory()->create();
        $user->assignRole('inspector');

        $response = $this->actingAs($user)->get('preventatives');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('supplies');
        $response->assertStatus(403);
    }

    public function test_users_can_not_access_preventative_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('preventatives');

        $response->assertStatus(403);
    }
}
