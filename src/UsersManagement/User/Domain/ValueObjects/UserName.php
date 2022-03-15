<?php

declare(strict_types=1);

namespace Src\UsersManagement\User\Domain\ValueObjects;

use Src\Shared\Domain\Exceptions\ValidationDomainException;
use Src\Shared\Domain\ValueObject\StringValueObject;

final class UserName extends StringValueObject
{

    /**
     * UserName constructor.
     * @param string $value
     * @throws ValidationDomainException
     */
    public function __construct(string $value)
    {
        $this->validate($value);
        parent::__construct($value);
    }

    /**
     * @param string $value
     * @throws ValidationDomainException
     */
    private function validate(string $value): void
    {
        if($value == "")
            throw new ValidationDomainException("El parametro [name] no puede estar vacio");

    }
}
