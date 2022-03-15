<?php

namespace Src\UsersManagement\User\Application;

use Src\Shared\Domain\Exceptions\ValidationDomainException;
use Src\UsersManagement\User\Domain\UserRepositoryContract;
use Src\UsersManagement\User\Domain\ValueObjects\UserEmail;
use Src\UsersManagement\User\Domain\ValueObjects\UserEmailId;


class UserEmailUpdator
{
    private UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->repository = $userRepository;
    }


    /**
     * Este servicio actualiza el email $email_id con el nuevo valor $email
     * @param int $email_id
     * @param string $email
     * @throws ValidationDomainException
     */
    public function execute(int $email_id, string $email): void
    {
        $id     = new UserEmailId($email_id);
        $email  = new UserEmail($email);

        $this->repository->updateEmail($id, $email);
    }

}
