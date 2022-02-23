<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Creamos usuario con credenciales para testing manual de pantallas
        User::factory()
            ->create(['password' => Hash::make('password')])
            ->emails()
            ->createMany([
                ['email' => "test@test.com"],
                ['email' => "alias@example.com"]
            ]);

        //Rellenamos con usuarios random
        User::factory(10)
            ->hasEmails(4)  //Creamos 4 emails aleatorios por cada user
            ->create();

    }
}
