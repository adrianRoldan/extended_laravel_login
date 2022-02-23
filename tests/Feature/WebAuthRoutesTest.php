<?php

namespace Tests\Feature;

use App\Models\User as EloquentUser;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class WebAuthRoutesTest extends TestCase
{

    use DatabaseMigrations; //Migramos antes de cada test en memoria

    /**
     * Test Ruta /, /dashboard, /users, /users/{id}
     */
    public function test_the_web_auth_protected_routes_returns_a_successful_response()
    {

        // Creamos un usuario
        $email = "test@example.com";
        $user = EloquentUser::factory()
            ->hasEmails(1, ["email" => $email])
            ->create();

        // Logueamos al usuario
        $this->post('/login', [
            'email'     => $email,
            'password'  => 'password',
        ]);

        //Intentamos acceder a las rutas protegidas
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/dashboard');
        $response->assertStatus(200);

        $response = $this->get('/users');
        $response->assertStatus(200);

        $response = $this->get('/users/'.$user->uuid);
        $response->assertStatus(200);
    }


    /**
     * Test ruta ficha usuario cuando el usuario no existe
     */
    public function test_the_show_user_route_when_user_not_exists()
    {
        // Creamos un usuario
        $email = "test@example.com";
        EloquentUser::factory()
            ->hasEmails(1, ["email" => $email])
            ->create();

        // Logueamos al usuario
        $this->post('/login', [
            'email'     => $email,
            'password'  => 'password',
        ]);

        $response = $this->get('/users/idThatNotExists');
        $response->assertStatus(404);
    }
}
