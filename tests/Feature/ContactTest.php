<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_contact_is_working()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('contacts');
        $response->assertOk();

        $response = $this->actingAs($user)->post('contacts', [
            'name' => 'Name',
            'title' => 'Title',
            'body' => 'Content',
        ]);
        $response->assertRedirect('contacts');
    }

    public function test_delete_contact_is_working()
    {
        Role::create(['name' => 'admin']);
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $contact = Contact::factory()->create();

        $this->assertDatabaseHas(Contact::class, ['name' => $contact->name]);

        $response = $this->actingAs($admin)->delete('contacts/' . $contact->id);
        $response->assertRedirect('contacts');

        $this->assertDatabaseMissing(Contact::class, ['name' => $contact->name]);
    }
}
