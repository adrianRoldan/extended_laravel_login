<?php

namespace Tests\Unit;

use App\Models\User;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class InMemoryDataBaseTest extends TestCase
{
    use DatabaseMigrations; //Antes de cada test realiza las migraciones en memoria

    public function test_sqlite_in_memory_database()
    {

        //Inserta un nuevo usuario en base de datos en memoria
        User::factory()
            ->hasEmails(1)
            ->create([
                "name"  => "TestingMemoryUser"
            ]);

        //Comprueba que existe el usuario introducido
        $this->assertDatabaseHas('users', [
            'name' => 'TestingMemoryUser'
        ]);
    }
}
