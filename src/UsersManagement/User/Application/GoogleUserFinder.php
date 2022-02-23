<?php


namespace Src\UsersManagement\User\Application;


use Src\UsersManagement\User\Domain\Entities\User;
use Src\UsersManagement\User\Domain\Exceptions\GoogleUserNotFound;
use Src\UsersManagement\User\Domain\ValueObjects\UserGoogleId;
use Src\UsersManagement\User\Domain\UserRepositoryContract;

class GoogleUserFinder
{

    private UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * @param string $google_id
     * @return User
     * @throws GoogleUserNotFound
     */
    public function execute(string $google_id): User
    {
        $google_id = new UserGoogleId($google_id);
        $user = $this->repository->findByGoogleId($google_id);

        if ($user === null)
            throw new GoogleUserNotFound($google_id);


        return $user;
    }
}
