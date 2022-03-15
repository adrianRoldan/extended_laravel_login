<?php

namespace Src\UsersManagement\Auth\Application\UseCase;


use Src\UsersManagement\Auth\Domain\Contracts\AuthProviderContract;

/**
 * Class LogoutService
 * Servicio de cierre de sesión que utiliza un proveedor externo
 *
 * @package Src\UsersManagement\Auth\Application\UseCase
 */
class LogoutService
{

    private AuthProviderContract $authProvider;


    public function __construct(AuthProviderContract $authProvider)
    {
        $this->authProvider = $authProvider;
    }


    public function execute(): void
    {
        $this->authProvider->logout();
    }
}
