<?php

namespace Src\UsersManagement\User\Application;

use Src\Shared\Domain\Exceptions\ValidationDomainException;
use Src\UsersManagement\User\Domain\Entities\User;
use Src\UsersManagement\User\Domain\UserRepositoryContract;
use Src\UsersManagement\User\Domain\ValueObjects\UserAvatar;
use Src\UsersManagement\User\Domain\ValueObjects\UserEmails;
use Src\UsersManagement\User\Domain\ValueObjects\UserGoogleId;
use Src\UsersManagement\User\Domain\ValueObjects\UserId;
use Src\UsersManagement\User\Domain\ValueObjects\UserName;
use Src\UsersManagement\User\Domain\ValueObjects\UserPassword;


class UserCreator
{
    private UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->repository = $userRepository;
    }


    /**
     * @param array<string,string> $data
     * @return User
     * @throws ValidationDomainException
     */
    public function execute(array $data): User
    {
        /** @var array<array<string,string>> $emails */
        $emails = $data['emails'];

        //Transformamos los datos de entrada en ValueObjects de Usuario
        $id         = Userid::generate();   //generamos identificador unico
        $name       = new UserName($data['name']);
        $password   = new UserPassword($data['password']);
        $emails     = new UserEmails($emails);
        $avatar     = new UserAvatar($data['avatar'] ?? null);
        $google_id  = new UserGoogleId($data['google_id'] ?? null);

        $user = User::create($id, $name, $password, $emails, $avatar, $google_id);

        $this->repository->save($user);

        return $user;
    }

}
