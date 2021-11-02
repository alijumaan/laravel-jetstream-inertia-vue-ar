<?php

namespace Tests\Feature;

use App\Models\Building;
use App\Models\Period;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class BuildingTest extends TestCase
{
    use RefreshDatabase;

    public function test_building_crud_by_admin_is_working()
    {
        Role::create(['name' => 'admin']);
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get('/preventatives/buildings');
        $response->assertOk();

        $period = Period::create(['period' => 'monthly']);
        $response = $this->actingAs($admin)->post('/preventatives/buildings',
            [
                'name' => 'Building One',
                'number' => '111',
                'status' => 1,
                'user_id' => $admin->id,
                'period_id' => $period->id,
            ]
        );

        $response->assertRedirect('preventatives/buildings');

        $building = Building::create(
            [
                'name' => 'Building Two',
                'number' => '222',
                'status' => 1,
                'user_id' => $admin->id,
                'period_id' => $period->id,
            ]
        );
        $response = $this->actingAs($admin)->put('/preventatives/buildings/' . $building->slug, [
            'name' => 'Building Three',
            'slug' => 'building-three',
            'number' => '333',
            'status' => 1,
            'user_id' => $admin->id,
            'period_id' => $period->id,
        ]);
        $response->assertRedirect('preventatives/buildings');

        $this->assertDatabaseHas(Building::class, ['name' => 'Building Three']);

        $response = $this->actingAs($admin)->delete('/preventatives/buildings/building-three');
        $response->assertRedirect('preventatives/buildings');

        $this->assertSoftDeleted(Building::class, ['name' => 'Building Three']);
    }

    public function test_inspector_role_can_create_building()
    {
        $permission = Permission::create(['name' => 'Create building']);
        $role = Role::create(['name' => 'inspector']);
        $role->givePermissionTo($permission);

        $user = User::factory()->create();
        $user->assignRole('inspector');

        $period = Period::create(['period' => 'monthly']);
        $response = $this->actingAs($user)->post('/preventatives/buildings',
            [
                'name' => 'Building One',
                'number' => '111',
                'status' => 1,
                'user_id' => $user->id,
                'period_id' => $period->id,
            ]
        );
        $response->assertRedirect('preventatives/buildings');
    }

    public function test_inspector_role_can_update_building()
    {
        $permission = Permission::create(['name' => 'Edit building']);
        $role = Role::create(['name' => 'inspector']);
        $role->givePermissionTo($permission);

        $user = User::factory()->create();
        $user->assignRole('inspector');

        $period = Period::create(['period' => 'monthly']);
        $building = Building::create(
            [
                'name' => 'Building Two',
                'number' => '222',
                'status' => 1,
                'user_id' => $user->id,
                'period_id' => $period->id,
            ]
        );
        $response = $this->actingAs($user)->put('/preventatives/buildings/' . $building->slug, [
            'name' => 'Building Three',
            'slug' => 'building-three',
            'number' => '333',
            'status' => 1,
            'user_id' => $user->id,
            'period_id' => $period->id,
        ]);
        $response->assertRedirect('preventatives/buildings');
    }

    public function test_users_can_not_access_building_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('preventatives/buildings');

        $response->assertStatus(403);
    }
}
