<?php

namespace Src\UsersManagement\Auth\Application\UseCase;


use Src\UsersManagement\Auth\Domain\Contracts\AuthProviderContract;
use Src\UsersManagement\Auth\Domain\Exceptions\AuthNotFoundExceptionDomain;

/**
 * Class LoginService
 * Servicio que loguea al usuario a través de un proveedor de autenticación externo
 *
 * @package Src\UsersManagement\Auth\Application\UseCase
 */
class LoginService
{

    private AuthProviderContract $authProvider;

    public function __construct(AuthProviderContract $authProvider)
    {
        $this->authProvider = $authProvider;
    }

    /**
     * @param array<string,string> $credentials
     * @return mixed
     * @throws AuthNotFoundExceptionDomain
     */
    public function execute(array $credentials): mixed
    {
        if (!$this->authProvider->attempt($credentials))
            throw new AuthNotFoundExceptionDomain('Correo electrónico o contraseña incorrectos.');

        return $this->authProvider->user();
    }
}
