<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class MysqlDataBaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_real_mysql_database()
    {
        DB::setDefaultConnection('mysql'); //Cambiamos el driver mysql para probar este test en la base de datos real

        //Inserta un nuevo usuario en base de datos
        User::factory()
            ->hasEmails(1)
            ->create([
                "name"  => "TestingUser"
            ]);


        //Comprueba que existe el usuario introducido
        $this->assertDatabaseHas('users', [
            'name' => 'TestingUser'
        ]);
    }
}
