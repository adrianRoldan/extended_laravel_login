<?php


namespace Src\UsersManagement\User\Infrastructure\Controllers;


use Src\Shared\Infrastructure\Response\ExceptionResponse;
use Src\Shared\Infrastructure\Response\MessageResponse;
use Src\UsersManagement\User\Application\UserEmailUpdator;
use Src\UsersManagement\User\Domain\UserRepositoryContract;
use Throwable;

class UpdateUserEmailController
{
    private UserEmailUpdator $updator;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->updator = new UserEmailUpdator($repository);
    }


    /**
     * @param int $id
     * @param string $email
     * @return ExceptionResponse|MessageResponse
     */
    public function __invoke(int $id, string $email)
    {
        try {
            $this->updator->execute($id, $email);
            return new MessageResponse("Email actualizado correctamente.");

        } catch (Throwable $exception){
            return new ExceptionResponse($exception->getMessage(), $exception);
        }
    }
}
