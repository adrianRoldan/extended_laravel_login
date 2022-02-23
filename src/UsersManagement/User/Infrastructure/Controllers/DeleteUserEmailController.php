<?php

namespace Src\UsersManagement\User\Infrastructure\Controllers;

use Src\Shared\Infrastructure\Response\ExceptionResponse;
use Src\Shared\Infrastructure\Response\MessageResponse;
use Src\UsersManagement\User\Application\UserEmailDeletor;
use Src\UsersManagement\User\Domain\UserRepositoryContract;
use Throwable;

class DeleteUserEmailController
{
    private UserEmailDeletor $deletor;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->deletor = new UserEmailDeletor($repository);
    }


    /**
     * @param int $id
     * @return ExceptionResponse|MessageResponse
     */
    public function __invoke(int $id)
    {
        try {
            $this->deletor->execute($id);
            return new MessageResponse("Email eliminado correctamente.");

        } catch (Throwable $exception){
            return new ExceptionResponse($exception->getMessage(), $exception);
        }
    }
}
