<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_auth_middleware_is_working()
    {
        $response = $this->get('/preventatives/buildings');
        $response->assertRedirect('/login');

        $response = $this->get('/preventatives/extinguishers');
        $response->assertRedirect('/login');

        $response = $this->get('/supplies/items');
        $response->assertRedirect('/login');
    }

    public function test_admin_middleware_is_working()
    {
        $user = User::factory()->create();
        Role::create(['name' => 'admin']);

        $response = $this->actingAs($user)->get('/permissions');
        $response->assertStatus(403);

        $response = $this->actingAs($user)->get('roles');
        $response->assertStatus(403);

        $response = $this->actingAs($user->assignRole('admin'))->get('/permissions');
        $response->assertStatus(200);

        $response = $this->actingAs($user->assignRole('admin'))->get('/roles');
        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('login'));

        $this->assertAuthenticated();

        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
