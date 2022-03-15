<?php

namespace Src\Shared\Domain\Exceptions;

use Src\Shared\Domain\Contracts\ExceptionContract;

class EntityNotFoundExceptionDomain extends DomainBaseException implements ExceptionContract
{
    private const GENERATED_STATUS = 404;
    protected string $debug_level = "critical";

    public function getGeneratedStatus(): int
    {
        return self::GENERATED_STATUS;
    }
}
