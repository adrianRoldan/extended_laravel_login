<?php

declare(strict_types=1);

namespace Src\UsersManagement\User\Domain\ValueObjects;


use Src\Shared\Domain\ValueObject\StringValueObject;

final class UserAvatar extends StringValueObject
{

    /**
     * UserAvatar constructor.
     * @param string|null $avatar
     */
    public function __construct(?string $avatar)
    {
        parent::__construct($avatar);
    }

}
