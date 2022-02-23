<?php

namespace Tests\Feature;

use Tests\TestCase;

class WebRoutesTest extends TestCase
{


    /**
     * Test rutas /login y /register
     */
    public function test_the_auth_routes_returns_a_successful_response()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);

        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_random_route_returns_a_not_found_response()
    {

        $response = $this->get('/randomRouteThatNotExists');
        $response->assertStatus(404);
    }

}
