<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObject;

/**
 * Class ArrayValueObject
 * Clase abstracta para definir valueObjects con un array como objeto de valor
 *
 * @package Src\Shared\Domain\ValueObject
 */
abstract class ArrayValueObject
{
    protected ?array $value;

    public function __construct(?array $value)
    {
        $this->value = $value;
    }

    public function value(): ?array
    {
        return $this->value;
    }

}
