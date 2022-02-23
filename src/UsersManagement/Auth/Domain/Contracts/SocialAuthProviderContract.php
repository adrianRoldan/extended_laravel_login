<?php


namespace Src\UsersManagement\Auth\Domain\Contracts;


interface SocialAuthProviderContract
{
    public function login();
    public function redirectToProvider();

    public function user();
}
