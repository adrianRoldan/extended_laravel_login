<?php

namespace Src\UsersManagement\Auth\Infrastruture\Controllers;

use Illuminate\Support\Facades\Log;
use Src\UsersManagement\Auth\Application\UseCase\RegisterService;
use Src\UsersManagement\Auth\Domain\Contracts\AuthProviderContract;
use Src\UsersManagement\Auth\Domain\Contracts\HashProviderContract;
use Throwable;

/**
 * Class RegisterController
 * Controlador que direcciona las peticiones hacia el servicio de Registro
 *
 * @package Src\UsersManagement\Auth\Infrastruture\Controllers
 */
class RegisterController
{

    private RegisterService $registerService;

    public function __construct(AuthProviderContract $authProvider, HashProviderContract $hasher)
    {
        $this->registerService = new RegisterService($authProvider, $hasher);
    }


    /**
     * @param array<string,string|array<array<string,string>>> $data
     * @throws Throwable
     */
    public function __invoke(array $data): void
    {
        try {

            $this->registerService->execute($data);

        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }
    }
}
