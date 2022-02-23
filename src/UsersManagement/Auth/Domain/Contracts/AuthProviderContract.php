<?php


namespace Src\UsersManagement\Auth\Domain\Contracts;


use Src\UsersManagement\User\Domain\Entities\User;

interface AuthProviderContract
{
    public function attempt(array $credentials);

    public function login(User $user);
    public function logout();

    public function register(array $data);

    public function user();
}
