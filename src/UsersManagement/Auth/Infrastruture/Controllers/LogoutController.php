<?php

namespace Src\UsersManagement\Auth\Infrastruture\Controllers;


use Src\Shared\Infrastructure\Response\BaseResponse;
use Src\Shared\Infrastructure\Response\ExceptionResponse;
use Src\UsersManagement\Auth\Application\UseCase\LogoutService;
use Src\UsersManagement\Auth\Domain\Contracts\AuthProviderContract;
use Throwable;

/**
 * Class LogoutController
 * Controlador que direcciona las peticiones hacia el servicio de Cierre de sesión
 *
 * @package Src\UsersManagement\Auth\Infrastruture\Controllers
 */
class LogoutController
{

    private LogoutService $logoutService;

    public function __construct(AuthProviderContract $authProvider)
    {
        $this->logoutService = new LogoutService($authProvider);
    }


    /**
     * @return BaseResponse|ExceptionResponse
     */
    public function __invoke()
    {
        try {
            $this->logoutService->execute();

            return new BaseResponse('Sesión cerrada correctamente');

        } catch (Throwable $e) {
            return new ExceptionResponse($e->getMessage(), $e);
        }
    }
}
