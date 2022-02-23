<?php


namespace Src\UsersManagement\Auth\Domain\Exceptions;

use Src\Shared\Domain\Contracts\ExceptionContract;
use Src\Shared\Domain\Exceptions\DomainBaseException;

class AuthNotFoundExceptionDomain extends DomainBaseException implements ExceptionContract
{
    protected $message = 'Correo electrónico o contraseña incorrectos.';
    protected string $debug_level = "info";

    private const GENERATED_STATUS = 422;

    public function getGeneratedStatus()
    {
        return self::GENERATED_STATUS;
    }
}
