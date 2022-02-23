<?php

namespace Src\Shared\Domain\Exceptions;

use Src\Shared\Domain\Contracts\ExceptionContract;

class HTTPMethodNotAllowed extends DomainBaseException implements ExceptionContract
{
    private const GENERATED_STATUS = 404;
    protected $message = "Verbo HTTP no soportado";

    public function getGeneratedStatus()
    {
        return self::GENERATED_STATUS;
    }
}
