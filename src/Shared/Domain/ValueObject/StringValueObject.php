<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObject;

/**
 * Class StringValueObject
 * Clase abstracta para definir valueObjects con un string como objeto de valor
 *
 * @package Src\Shared\Domain\ValueObject
 */
abstract class StringValueObject
{
    protected ?string $value;

    public function __construct(?string $value)
    {
        $this->value = $value;
    }

    public function value(): ?string
    {
        return $this->value;
    }
}
