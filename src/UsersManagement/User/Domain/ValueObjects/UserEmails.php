<?php

declare(strict_types=1);

namespace Src\UsersManagement\User\Domain\ValueObjects;

use Src\Shared\Domain\Exceptions\ValidationDomainException;
use Src\Shared\Domain\ValueObject\ArrayValueObject;

final class UserEmails extends ArrayValueObject
{

    /** @var array<int,array<string, string>> **/
    protected array $value;
    /**
     * UserEmails constructor.
     * @param array<array<string,string>> $value
     * @throws ValidationDomainException
     */
    public function __construct(array $value)
    {
        $this->validate($value);
        parent::__construct($value);
    }

    /**
     * @return array<int,array<string, string>>
     */
    public function value(): array
    {
        return $this->value;
    }

    /**
     * @param array<array<string,string>> $value
     * @throws ValidationDomainException
     */
    private function validate(array $value): void
    {
        if(empty($value))
            throw new ValidationDomainException("Has de indicar como mínimo un email.");

        foreach($value as $email) {

            if(!isset($email['email']))
                throw new ValidationDomainException("Formato de emails incorrecto.");

            if(!filter_var($email['email'], FILTER_VALIDATE_EMAIL))
                throw new ValidationDomainException("El email (" . $email['email'] . ") no es correcto.");
        }


    }
}
