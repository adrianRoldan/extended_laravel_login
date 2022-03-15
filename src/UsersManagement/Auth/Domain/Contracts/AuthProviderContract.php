<?php


namespace Src\UsersManagement\Auth\Domain\Contracts;


use Src\UsersManagement\User\Domain\Entities\User;

interface AuthProviderContract
{
    /**
     * @param array<string,string> $credentials
     * @return bool
     */
    public function attempt(array $credentials): bool;

    /**
     * @param User $user
     * @return void
     */
    public function login(User $user): void;

    /**
     * @return void
     */
    public function logout(): void;

    /**
     * @param array<string,mixed> $data
     * @return void
     */
    public function register(array $data): void;

    /**
     * @return mixed
     */
    public function user(): mixed;
}
