<?php

namespace Tests\Feature\Auth;

use App\Models\User as EloquentUser;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        $email = "test@example.com";

        //Persistimos en base de datos para probar el login
        EloquentUser::factory()
            ->hasEmails(1, ["email" => $email])
            ->create();

        $response = $this->post('/login', [
            'email'     => $email,
            'password'  => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $email = "test@example.com";

        EloquentUser::factory()
            ->hasEmails(1, ["email" => "test@example.com"])
            ->create();

        $this->post('/login', [
            'email'     => $email,
            'password'  => 'claveIncorrecta',
        ]);

        $this->assertGuest();
    }
}
