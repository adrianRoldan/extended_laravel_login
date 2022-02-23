<?php

namespace Src\Shared\Domain\Exceptions;

use Src\Shared\Domain\Contracts\ExceptionContract;

class IncorrectJSONFormat extends DomainBaseException implements ExceptionContract
{
    private const GENERATED_STATUS = 404;
    protected string $debug_level = "warning";
    protected $message = "Formato de entrada JSON incorrecto.";

    public function getGeneratedStatus()
    {
        return self::GENERATED_STATUS;
    }
}
