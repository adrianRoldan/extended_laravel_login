<?php


namespace Src\UsersManagement\User\Domain\Exceptions;


use Src\UsersManagement\User\Domain\ValueObjects\UserGoogleId;
use Src\Shared\Domain\Contracts\ExceptionContract;
use Src\Shared\Domain\Exceptions\DomainBaseException;

class GoogleUserNotFound extends DomainBaseException implements ExceptionContract
{
    private const GENERATED_STATUS = 404;

    public function __construct(UserGoogleId $id)
    {
        parent::__construct("El usuario con id de google {$id->value()} no ha sido encontrado.", self::GENERATED_STATUS, null);
    }

    public function getGeneratedStatus()
    {
        return self::GENERATED_STATUS;
    }
}
