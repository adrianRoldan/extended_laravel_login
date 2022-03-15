<?php


namespace Src\UsersManagement\Auth\Domain\Contracts;


interface SocialAuthProviderContract
{
    public function login(): mixed;
    public function redirectToProvider(): mixed;

    public function user(): mixed;
}
