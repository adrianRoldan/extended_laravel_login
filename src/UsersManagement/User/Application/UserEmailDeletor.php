<?php

namespace Src\UsersManagement\User\Application;

use Src\UsersManagement\User\Domain\UserRepositoryContract;
use Src\UsersManagement\User\Domain\ValueObjects\UserEmailId;


class UserEmailDeletor
{
    private UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->repository = $userRepository;
    }


    /**
     * @param int $id
     */
    public function execute(int $id): void
    {
        $id = new UserEmailId($id);
        $this->repository->deleteEmail($id);
    }
}
