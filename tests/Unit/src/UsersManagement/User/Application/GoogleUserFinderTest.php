<?php

namespace Tests\Unit\src\UsersManagement\User\Application;

use App\Models\User as EloquentUser;
use App\Models\UserEmailAlias as EloquentUserEmailAlias;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Ramsey\Uuid\Uuid;
use Src\UsersManagement\User\Application\GoogleUserFinder;
use Src\UsersManagement\User\Domain\Entities\User;
use Src\UsersManagement\User\Domain\Exceptions\GoogleUserNotFound;
use Src\UsersManagement\User\Domain\Exceptions\UserNotFound;
use Src\UsersManagement\User\Domain\ValueObjects\UserAvatar;
use Src\UsersManagement\User\Domain\ValueObjects\UserEmails;
use Src\UsersManagement\User\Domain\ValueObjects\UserGoogleId;
use Src\UsersManagement\User\Domain\ValueObjects\UserId;
use Src\UsersManagement\User\Domain\ValueObjects\UserName;
use Src\UsersManagement\User\Domain\ValueObjects\UserPassword;
use Tests\TestCase;
use Src\Shared\Domain\Exceptions\ValidationDomainException;
use Src\UsersManagement\User\Application\UserFinder;
use Src\UsersManagement\User\Infrastructure\Repositories\EloquentUserRepository;

class GoogleUserFinderTest extends TestCase
{
    use DatabaseMigrations; //Migramos antes de cada test en memoria


    /**
     * @throws ValidationDomainException
     * @throws GoogleUserNotFound
     */
    public function test_google_user_finder_service_returns_correct_data()
    {
        //Persistimos en base de datos para obtenerlo con UserFinder
        $createdUser = EloquentUser::factory()
            ->hasEmails(1)
            ->create();

        //Llamamos al servicio que busca un usuario en BBDD a partir del id de google
        $creator = new GoogleUserFinder(new EloquentUserRepository(new EloquentUser(), new EloquentUserEmailAlias()));
        $response = $creator->execute($createdUser->google_id);


        //Formamos lo que esperamos obtener
        $id         = new UserId($createdUser->uuid);
        $name       = new UserName($createdUser->name);
        $password   = new UserPassword($createdUser->password);
        $emails     = new UserEmails($createdUser->emails->toArray());
        $avatar     = new UserAvatar($createdUser->avatar);
        $google_id  = new UserGoogleId($createdUser->google_id);

        $expected = new User($id, $name, $password, $emails, $avatar, $google_id);


        $this->assertEquals($expected, $response);
    }


    /**
     * @throws GoogleUserNotFound
     */
    public function test_google_user_finder_service_when_user_not_found_in_database()
    {

        $this->expectException(GoogleUserNotFound::class);

        //Llamamos al servicio que busca un usuario en BBDD
        $creator = new GoogleUserFinder(new EloquentUserRepository(new EloquentUser(), new EloquentUserEmailAlias()));
        $creator->execute("randomGoogleIdThatNotExistsInDatabase");  //Buscamos user con un nuevo identifcador unico, que no existe en BBDD
    }
}
