<?php

namespace Tests\Unit\src\UsersManagement\User\Application;

use App\Models\User as EloquentUser;
use App\Models\UserEmailAlias as EloquentUserEmailAlias;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Src\Shared\Domain\Exceptions\ValidationDomainException;
use Tests\TestCase;
use Src\UsersManagement\User\Application\UserCreator;
use Src\UsersManagement\User\Domain\Entities\User;
use Src\UsersManagement\User\Domain\ValueObjects\UserAvatar;
use Src\UsersManagement\User\Domain\ValueObjects\UserEmails;
use Src\UsersManagement\User\Domain\ValueObjects\UserGoogleId;
use Src\UsersManagement\User\Domain\ValueObjects\UserId;
use Src\UsersManagement\User\Domain\ValueObjects\UserName;
use Src\UsersManagement\User\Domain\ValueObjects\UserPassword;
use Src\UsersManagement\User\Infrastructure\Repositories\EloquentUserRepository;


class UserCreatorTest extends TestCase
{
    use DatabaseMigrations; //Antes de cada test realiza las migraciones en memoria

    /**
     * @throws ValidationDomainException
     */
    public function test_user_creator_service_returns_correct_data()
    {

        $id         = Userid::generate();
        $name       = new UserName("Testing User");
        $password   = new UserPassword("password");
        $emails     = new UserEmails([["email" => "test@test.com"]]);
        $avatar     = new UserAvatar("profile.png");
        $google_id  = new UserGoogleId("352346-21343-1");

        $expected = new User($id, $name, $password, $emails, $avatar, $google_id);

        $dataToCreate = [
            'name'      => "Testing User",
            'password'  => "password",
            'emails'    => [["email" => "test@test.com"]],
            'avatar'    => "profile.png",
            'google_id' => "352346-21343-1"
        ];

        $creator = new UserCreator(new EloquentUserRepository(new EloquentUser(), new EloquentUserEmailAlias()));
        $response = $creator->execute($dataToCreate);

        $this->assertEquals($expected->name(), $response->name());
        $this->assertEquals($expected->password(), $response->password());
        $this->assertEquals($expected->emails(), $response->emails());
        $this->assertEquals($expected->avatar(), $response->avatar());
        $this->assertEquals($expected->googleId(), $response->googleId());
    }



    /**
     * @throws ValidationDomainException
     */
    public function test_user_creator_service_store_in_database()
    {

        $dataToCreate = [
            'name'      => "Testing User",
            'password'  => "password",
            'emails'    => [["email" => "test@test.com"]],
            'avatar'    => "profile.png",
            'google_id' => "352346-21343-112512512"
        ];

        $creator = new UserCreator(new EloquentUserRepository(new EloquentUser(), new EloquentUserEmailAlias()));
        $creator->execute($dataToCreate);

        $this->assertDatabaseHas('users', [
            'google_id' => '352346-21343-112512512'
        ]);
    }
}
