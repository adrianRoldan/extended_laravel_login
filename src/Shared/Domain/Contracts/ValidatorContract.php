<?php


namespace Src\Shared\Domain\Contracts;


use Src\Shared\Domain\Exceptions\ValidationDomainException;

interface ValidatorContract
{

    /**
     * ValidatorContract constructor.
     * @param RulesValidations $rules
     */
    public function __construct(RulesValidations $rules);

    /**
     * @param array $data
     * @return bool
     * @throws ValidationDomainException
     */
    public function validate(array $data): bool;
}
