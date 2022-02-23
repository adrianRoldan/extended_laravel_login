<?php

namespace Src\UsersManagement\Auth\Infrastruture\Controllers;

use Illuminate\Support\Facades\Log;
use Src\UsersManagement\Auth\Application\UseCase\LoginService;
use Src\UsersManagement\Auth\Domain\Contracts\AuthProviderContract;
use Src\UsersManagement\Auth\Domain\Exceptions\AuthNotFoundExceptionDomain;
use Throwable;

/**
 * Class LoginController
 * Controlador que direcciona las peticiones hacia el servicio de Login
 *
 * @package Src\UsersManagement\Auth\Infrastruture\Controllers
 */
class LoginController
{

    private LoginService $loginService;

    public function __construct(AuthProviderContract $authProvider)
    {
        $this->loginService = new LoginService($authProvider);
    }

    /**
     * @param $credentials
     * @throws Throwable
     * @throws AuthNotFoundExceptionDomain
     */
    public function __invoke($credentials)
    {
        try {

            return $this->loginService->execute($credentials);

        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }
    }
}
