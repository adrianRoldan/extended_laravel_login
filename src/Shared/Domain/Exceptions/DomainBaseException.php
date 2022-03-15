<?php

namespace Src\Shared\Domain\Exceptions;

use Exception;
use Throwable;

/**
 * Class DomainBaseException
 * Clase Abstracta que extiende de la clase genérica Excepcion. Define una serie de métodos
 * para las clases de excepcion de dominio
 *
 * @package Src\Shared\Domain\Exceptions
 */
abstract class DomainBaseException extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        if(!empty($message) or (!empty($message) and !empty($code)))
            parent::__construct($message, $this->getGeneratedStatus(), $previous);
    }


    abstract public function getGeneratedStatus(): int;
}
