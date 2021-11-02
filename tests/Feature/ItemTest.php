<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_item_crud_is_working()
    {
        Role::create(['name' => 'admin']);

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get('supplies/items');
        $response->assertOk();

        $response = $this->actingAs($admin)->get('supplies/items/create');
        $response->assertOk();

        $response = $this->actingAs($admin)->post('supplies/items', ['nomenclature' => 'Test']);
        $response->assertRedirect('supplies/items');

        $item = Item::factory()->create();

        $response = $this->actingAs($admin)->put('supplies/items/' . $item->id, ['nomenclature' => 'Test updated']);
        $response->assertRedirect('supplies/items');

        $this->assertDatabaseHas(Item::class, ['nomenclature' => 'Test updated']);

        $response = $this->actingAs($admin)->delete('/supplies/items/' . $item->id);
        $response->assertOk();

        $this->assertSoftDeleted(Item::class, ['nomenclature' => 'Test updated']);
    }
}
