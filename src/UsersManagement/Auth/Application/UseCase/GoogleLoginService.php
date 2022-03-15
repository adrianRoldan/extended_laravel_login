<?php

namespace Src\UsersManagement\Auth\Application\UseCase;


use Src\UsersManagement\Auth\Domain\Contracts\SocialAuthProviderContract;

/**
 * Class GoogleLoginService
 * Implementa el servicio que loguea al usuario a través de un proveedor externo de inicio de sesión de redes sociales
 *
 * @package Src\UsersManagement\Auth\Application\UseCase
 */
class GoogleLoginService
{

    private SocialAuthProviderContract $socialAuthProvider;

    public function __construct(SocialAuthProviderContract $socialAuthProvider)
    {
        $this->socialAuthProvider = $socialAuthProvider;
    }

    /**
     * @return mixed
     */
    public function login(): mixed
    {
        return $this->socialAuthProvider->login();
    }


    /**
     * @return mixed
     */
    public function redirect(): mixed
    {
        return $this->socialAuthProvider->redirectToProvider();
    }
}
