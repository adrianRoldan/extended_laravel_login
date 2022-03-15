<?php

namespace Src\UsersManagement\User\Application;

use Src\Shared\Domain\Exceptions\ValidationDomainException;
use Src\UsersManagement\User\Domain\UserRepositoryContract;
use Src\UsersManagement\User\Domain\ValueObjects\UserId;


class UserDeletor
{
    private UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * @param string $id
     * @throws ValidationDomainException
     */
    public function execute(string $id): void
    {
        //Transformamos el string de entrada en un Identificador de Usuario único
        $id = new UserId($id);

        $this->repository->delete($id);
    }

}
