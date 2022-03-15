<?php

namespace Src\UsersManagement\Auth\Application\UseCase;

use Src\UsersManagement\Auth\Domain\Contracts\AuthProviderContract;
use Src\UsersManagement\Auth\Domain\Contracts\HashProviderContract;

/**
 * Class RegisterService
 * Servicio que regisra al usuario a través de un proveedor de autenticación externo
 *
 * @package Src\UsersManagement\Auth\Application\UseCase
 */
class RegisterService
{

    private AuthProviderContract $authProvider;
    private HashProviderContract $hashProvider; //Proveedor externo de encriptación

    public function __construct(AuthProviderContract $authProvider, HashProviderContract $hashProvider)
    {
        $this->authProvider = $authProvider;
        $this->hashProvider = $hashProvider;
    }

    /**
     * @param array<string,mixed|string> $data
     */
    public function execute(array $data): void
    {
        /** @var string $password */
        $password = $data['password'];
        $this->authProvider->register([
            'name'      => $data['name'],
            'password'  => $this->hashProvider->hash($password),
            'emails'    => [["email" => $data['email']]]
        ]);
    }
}
