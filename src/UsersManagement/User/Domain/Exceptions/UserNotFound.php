<?php


namespace Src\UsersManagement\User\Domain\Exceptions;


use Src\UsersManagement\User\Domain\ValueObjects\UserId;
use Src\Shared\Domain\Contracts\ExceptionContract;
use Src\Shared\Domain\Exceptions\DomainBaseException;

class UserNotFound extends DomainBaseException implements ExceptionContract
{
    private const GENERATED_STATUS = 404;

    public function __construct(UserId $id)
    {
        parent::__construct("El usuario con id {$id->value()} no ha sido encontrado.", self::GENERATED_STATUS, null);
    }

    /**
     * @return int
     */
    public function getGeneratedStatus()
    {
        return self::GENERATED_STATUS;
    }
}
