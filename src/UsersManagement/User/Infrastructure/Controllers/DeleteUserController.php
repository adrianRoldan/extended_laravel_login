<?php

namespace Src\UsersManagement\User\Infrastructure\Controllers;

use Src\Shared\Infrastructure\Response\ExceptionResponse;
use Src\Shared\Infrastructure\Response\MessageResponse;
use Src\UsersManagement\User\Application\UserDeletor;
use Src\UsersManagement\User\Domain\UserRepositoryContract;
use Throwable;

class DeleteUserController
{
    private UserDeletor $deletor;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->deletor = new UserDeletor($repository);
    }


    /**
     * @param string $id
     * @return ExceptionResponse|MessageResponse
     */
    public function __invoke(string $id)
    {
        try {
            $this->deletor->execute((string) $id);
            return new MessageResponse("Usuario eliminado correctamente.");

        } catch (Throwable $exception){
            return new ExceptionResponse($exception->getMessage(), $exception);
        }
    }
}
