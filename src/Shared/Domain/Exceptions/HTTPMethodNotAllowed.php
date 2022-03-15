<?php

namespace Src\Shared\Domain\Exceptions;

use Src\Shared\Domain\Contracts\ExceptionContract;

class HTTPMethodNotAllowed extends DomainBaseException implements ExceptionContract
{

    /** @var string */
    protected $message = "Verbo HTTP no soportado";
    private const GENERATED_STATUS = 404;

    public function getGeneratedStatus(): int
    {
        return self::GENERATED_STATUS;
    }
}
