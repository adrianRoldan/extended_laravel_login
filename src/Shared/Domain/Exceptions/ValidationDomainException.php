<?php

namespace Src\Shared\Domain\Exceptions;

use Src\Shared\Domain\Contracts\ExceptionContract;

class ValidationDomainException extends DomainBaseException implements ExceptionContract
{
    private const GENERATED_STATUS = 422;

    public function getGeneratedStatus(): int
    {
        return self::GENERATED_STATUS;
    }
}
