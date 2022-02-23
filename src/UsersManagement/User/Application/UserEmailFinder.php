<?php

namespace Src\UsersManagement\User\Application;

use Src\UsersManagement\User\Domain\Exceptions\UserEmailNotFound;
use Src\UsersManagement\User\Domain\ValueObjects\UserEmail;
use Src\UsersManagement\User\Domain\UserRepositoryContract;

class UserEmailFinder
{

    private UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->repository = $userRepository;
    }


    /**
     * @param string $email
     * @return UserEmail
     * @throws UserEmailNotFound
     */
    public function execute(string $email): UserEmail
    {
        $userEmail = new UserEmail($email);
        $email = $this->repository->findEmail($userEmail);

        if ($email === null)
            throw new UserEmailNotFound($userEmail);


        return $email;
    }
}
