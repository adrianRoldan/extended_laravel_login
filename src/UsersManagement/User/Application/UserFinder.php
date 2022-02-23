<?php


namespace Src\UsersManagement\User\Application;


use Src\Shared\Domain\Exceptions\ValidationDomainException;
use Src\UsersManagement\User\Domain\Entities\User;
use Src\UsersManagement\User\Domain\Exceptions\UserNotFound;
use Src\UsersManagement\User\Domain\UserRepositoryContract;
use Src\UsersManagement\User\Domain\ValueObjects\UserId;

class UserFinder
{

    private UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * @param string $user_id
     * @return User
     * @throws ValidationDomainException|UserNotFound
     */
    public function execute(string $user_id): User
    {
        $user_id = new UserId($user_id);
        $user = $this->repository->find($user_id);

        if ($user === null)
            throw new UserNotFound($user_id);


        return $user;
    }
}
