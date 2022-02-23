<?php

declare(strict_types=1);

namespace Src\Shared\Domain\ValueObject;

use Src\Shared\Domain\Exceptions\ValidationDomainException;
use Src\Shared\Infrastructure\Services\RamseyUuidProvider;

/**
 * Class UuidValueObject
 * Clase abstracta para definir valueObjects con un identificar unico universal (uuid) como objeto de valor
 *
 * @package Src\Shared\Domain\ValueObject
 */
abstract class UuidValueObject
{
    protected string $value;

    /**
     * UuidValueObject constructor.
     * @param string $value
     * @throws ValidationDomainException
     */
    public function __construct(string $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    /**
     * @return static
     * @throws ValidationDomainException
     */
    public static function generate(): self
    {
        $uuidGenerator = new RamseyUuidProvider();
        $uuid = $uuidGenerator->generate();  //generamos nuevo identificador único universal
        return new static($uuid);
    }

    /**
     * @param string $value
     * @throws ValidationDomainException
     */
    private function validate(string $value)
    {
        if($value == "")
            throw new ValidationDomainException("El ID es obligatorio");

        //Validamos que el valor de entrada tenga el formato estandar de un uuid
        if (!is_string($value) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $value) !== 1))
            throw new ValidationDomainException("El ID único ($value) no tiene el formato correcto.");

    }
}
