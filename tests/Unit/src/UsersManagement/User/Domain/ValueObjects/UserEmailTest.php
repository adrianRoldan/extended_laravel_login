<?php

namespace Tests\Unit\src\UsersManagement\User\Domain\ValueObjects;

use Tests\TestCase;
use Src\Shared\Domain\Exceptions\ValidationDomainException;
use Src\UsersManagement\User\Domain\ValueObjects\UserEmail;

class UserEmailTest extends TestCase
{

    public function test_create_user_email_when_valid_data_given()
    {
        $email = "test@test.com";

        $userEmail = new UserEmail($email);

        $this->assertEquals($email, $userEmail->value());
    }


    public function test_create_user_email_when_invalid_data_given()
    {
        $this->expectException(ValidationDomainException::class);
        new UserEmail("invalidEmail@ñ.es");
    }
}

