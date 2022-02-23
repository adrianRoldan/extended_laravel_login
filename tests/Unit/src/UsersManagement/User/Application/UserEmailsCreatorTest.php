<?php

namespace Tests\Unit\src\UsersManagement\User\Application;

use App\Models\User as EloquentUser;
use App\Models\UserEmailAlias as EloquentUserEmailAlias;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Src\Shared\Domain\Exceptions\ValidationDomainException;
use Src\UsersManagement\User\Application\UserEmailsCreator;
use Src\UsersManagement\User\Domain\Exceptions\UserEmailAlreadyExists;
use Src\UsersManagement\User\Infrastructure\Repositories\EloquentUserRepository;

class UserEmailsCreatorTest extends TestCase
{

    use DatabaseMigrations;


    /**
     * @throws UserEmailAlreadyExists
     * @throws ValidationDomainException
     */
    public function test_email_creator_when_email_not_exists()
    {
        //Persistimos en base de datos un usuario con un email para que el servicio le asigne uno nuevo
        $createdUser = EloquentUser::factory()
            ->hasEmails(1, ["email" => "test@test.com"])
            ->create();

        $newEmail = "test@test.es";

        $emailCreator = new UserEmailsCreator(new EloquentUserRepository(new EloquentUser(), new EloquentUserEmailAlias()));
        $emailCreator->execute($createdUser->uuid, [["email" => $newEmail]]);

        //Comprueba que existe el email que el servicio acaba de crear
        $this->assertDatabaseHas('user_email_aliases', [
            'email' => $newEmail
        ]);

    }

    public function test_email_creator_when_email_already_exists()
    {
        $this->expectException(UserEmailAlreadyExists::class);

        $email = "test@test.es";
        //Persistimos en base de datos un usuario con un email para que el servicio intente asignarle el mismo
        $createdUser = EloquentUser::factory()
            ->hasEmails(1, ["email" => $email])
            ->create();


        $emailCreator = new UserEmailsCreator(new EloquentUserRepository(new EloquentUser(), new EloquentUserEmailAlias()));
        $emailCreator->execute($createdUser->uuid, [["email" => $email]]);  //Ejecutamos servicio para insertar email que ya existe

    }
}
