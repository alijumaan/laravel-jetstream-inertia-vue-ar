<?php

namespace Tests\Feature;

use App\Models\Building;
use App\Models\BuildingExtinguisher;
use App\Models\Extinguisher;
use App\Models\Period;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ExtinguisherTest extends TestCase
{
    use RefreshDatabase;

    public function test_extinguisher_crud_by_admin_is_working()
    {
        Role::create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->assignRole('admin');

        $extinguisher = Extinguisher::create(['type' => 'water', 'slug' => 'water']);

        $response = $this->actingAs($user)->get('/preventatives/extinguishers');
        $response->assertOk();

        $extinguisher->update(['type' => 'foam', 'slug' => 'foam']);

        $response = $this->actingAs($user)->get('/preventatives/extinguishers');
        $response->assertOk();

        $this->assertDatabaseHas(Extinguisher::class, ['type' => 'foam']);

        $response = $this->actingAs($user)->delete('/preventatives/extinguishers/foam');
        $response->assertRedirect('preventatives/extinguishers');

        $this->assertSoftDeleted(Extinguisher::class, ['type' => 'foam']);
    }

    public function test_pull_extinguisher_from_building_by_admin()
    {
        Role::create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->assignRole('admin');

        $extinguisher = Extinguisher::create(['type' => 'water', 'slug' => 'water']);
        $period = Period::create(['period' => 'monthly']);
        $building = Building::create([
            'name' => 'Building',
            'number' => '111',
            'status' => 1,
            'user_id' => $user->id,
            'period_id' => $period->id
        ]);

        $response = $this->actingAs($user)->post('/preventatives/extinguishers', [
            'building_id' => $building->id,
            'extinguisher_id' => $extinguisher->id,
        ]);

        $response->assertRedirect('preventatives/extinguishers');
    }

    public function test_return_extinguisher_to_building_by_admin()
    {
        Role::create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->assignRole('admin');

        $extinguisher = Extinguisher::create(['type' => 'water', 'slug' => 'water']);
        $period = Period::create(['period' => 'monthly']);
        $building = Building::create([
            'name' => 'Building',
            'number' => '111',
            'status' => 1,
            'user_id' => $user->id,
            'period_id' => $period->id
        ]);

        $response = $this->actingAs($user)->post('/preventatives/extinguishers', [
            'building_id' => $building->id,
            'extinguisher_id' => $extinguisher->id,
        ]);

        $response->assertRedirect('preventatives/extinguishers');

        $response = $this->actingAs($user)->delete('/preventatives/extinguishers/'. $extinguisher->id . '/' . $building->id);
        $response->assertRedirect('preventatives/extinguishers');

        $this->assertDatabaseMissing(BuildingExtinguisher::class, ['extinguisher_id' => $extinguisher->id]);
    }

    public function test_inspector_role_can_create_and_update_extinguisher()
    {
        $permissions = [
            'Access extinguisher',
            'Create extinguisher',
            'Edit extinguisher',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::create(['name' => 'inspector']);
        $role->givePermissionTo($permissions);

        $user = User::factory()->create();
        $user->assignRole('inspector');

        $extinguisher = Extinguisher::create(['type' => 'water', 'slug' => 'water']);

        $response = $this->actingAs($user)->get('/preventatives/extinguishers');
        $response->assertOk();

        $extinguisher->update(['type' => 'foam', 'slug' => 'foam']);

        $response = $this->actingAs($user)->get('/preventatives/extinguishers');
        $response->assertOk();
    }

    public function test_users_can_not_access_extinguisher_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('preventatives/extinguishers');

        $response->assertStatus(403);
    }
}
