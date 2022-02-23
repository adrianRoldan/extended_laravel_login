<?php

namespace Src\UsersManagement\User\Application;

use Src\Shared\Domain\Exceptions\ValidationDomainException;
use Src\UsersManagement\User\Domain\UserRepositoryContract;
use Src\UsersManagement\User\Domain\ValueObjects\UserEmails;
use Src\UsersManagement\User\Domain\ValueObjects\UserId;

class UserEmailsSearcher
{
    private UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->repository = $userRepository;
    }


    /**
     * Este servicio retorna los emails del user $user_id
     *
     * @param string $user_id
     * @return mixed
     * @throws ValidationDomainException
     */
    public function execute(string $user_id): UserEmails
    {
        $user_id = new UserId($user_id);
        return $this->repository->getEmailsByUser($user_id);
    }
}
