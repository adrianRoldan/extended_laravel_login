<?php

declare(strict_types=1);

namespace Src\UsersManagement\User\Domain\ValueObjects;

use Src\Shared\Domain\Exceptions\ValidationDomainException;
use Src\Shared\Domain\ValueObject\StringValueObject;

final class UserEmail extends StringValueObject
{
    /**
     * UserEmail constructor.
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
    private function validate(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL))
            throw new ValidationDomainException("El email (".$value.") no es correcto.");


    }
}
