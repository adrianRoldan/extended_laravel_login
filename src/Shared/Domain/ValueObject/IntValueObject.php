<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObject;


use Src\Shared\Domain\Exceptions\ValidationDomainException;

/**
 * Class IntValueObject
 * Clase abstracta para definir valueObjects con un entero como objeto de valor
 *
 * @package Src\Shared\Domain\ValueObject
 */
abstract class IntValueObject
{
    protected int $value;

    public function __construct(int|string $value)
    {
        $this->validate($value);
        $this->value = (int) $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    /**
     * @param int|string $value
     * @throws ValidationDomainException
     */
    private function validate(int|string $value): void
    {
        if(!is_numeric($value))
            throw new ValidationDomainException("El ID introducido no tiene un formato numerico.");

        $options = array(
            'options' => array(
                'min_range' => 1,
            )
        );

        //Validamos que sea un entero
        if (!filter_var($value, FILTER_VALIDATE_INT, $options)) {
            throw new ValidationDomainException("El ID ($value) no es correcto. Revisa que no sea inferior a 1.");
        }
    }
}
