<?php

namespace Tests\Unit\src\UsersManagement\User\Domain\ValueObjects;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Src\Shared\Domain\Exceptions\ValidationDomainException;
use Src\UsersManagement\User\Domain\ValueObjects\UserId;

class UserIdTest extends TestCase
{


    /**
     * @throws ValidationDomainException
     */
    public function test_create_user_id_when_valid_data_given_with_constructor()
    {
        $uuid = Uuid::uuid4()->toString();  //generamos nuevo uuid

        $userId = new UserId($uuid);    //creamos valueObject con el uuid

        $this->assertEquals($uuid, $userId->value());
    }


    public function test_create_user_id_when_invalid_data_given()
    {

        $this->expectException(ValidationDomainException::class);
        new UserId("invalidUuid");
    }
}
