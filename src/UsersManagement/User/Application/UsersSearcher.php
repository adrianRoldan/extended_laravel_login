<?php


namespace Src\UsersManagement\User\Application;


use Src\UsersManagement\User\Domain\UserRepositoryContract;

class UsersSearcher
{
    private UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->repository = $userRepository;
    }


    /**
     * Este servicio retorna todos los usuarios
     */
    public function execute(): mixed
    {
        return $this->repository->all();
    }
}
