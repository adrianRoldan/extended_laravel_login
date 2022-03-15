<?php

namespace Src\Shared\Domain\Exceptions;

use Src\Shared\Domain\Contracts\ExceptionContract;

class IncorrectJSONFormat extends DomainBaseException implements ExceptionContract
{
    /** @var string */
    protected $message = "Formato de entrada JSON incorrecto.";
    private const GENERATED_STATUS = 404;
    protected string $debug_level = "warning";

    public function getGeneratedStatus(): int
    {
        return self::GENERATED_STATUS;
    }
}
