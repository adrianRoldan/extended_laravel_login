<?php


namespace Src\UsersManagement\Auth\Infrastruture\Controllers;

use Src\UsersManagement\Auth\Application\UseCase\GoogleLoginService;
use Src\UsersManagement\Auth\Domain\Contracts\SocialAuthProviderContract;

/**
 * Class GoogleLoginController
 * Controlador que direcciona las peticiones hacia los servicios de autenticación de Google
 *
 * @package Src\UsersManagement\Auth\Infrastruture\Controllers
 */
class GoogleLoginController
{

    private GoogleLoginService $googleLoginService;

    public function __construct(SocialAuthProviderContract $socialAuthProvider)
    {
        $this->googleLoginService = new GoogleLoginService($socialAuthProvider);
    }

    public function redirect(): mixed
    {
        return $this->googleLoginService->redirect();
    }

    public function login(): mixed
    {
        return $this->googleLoginService->login();
    }
}
