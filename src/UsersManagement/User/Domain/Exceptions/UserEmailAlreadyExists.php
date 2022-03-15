<?php


namespace Src\UsersManagement\User\Domain\Exceptions;


use Src\UsersManagement\User\Domain\ValueObjects\UserEmail;
use Src\Shared\Domain\Contracts\ExceptionContract;
use Src\Shared\Domain\Exceptions\DomainBaseException;

class UserEmailAlreadyExists extends DomainBaseException implements ExceptionContract
{
    private const GENERATED_STATUS = 404;

    public function __construct(UserEmail $email)
    {
        parent::__construct("El email {$email->value()} ya está registrado.", self::GENERATED_STATUS, null);
    }

    public function getGeneratedStatus(): int
    {
        return self::GENERATED_STATUS;
    }
}
