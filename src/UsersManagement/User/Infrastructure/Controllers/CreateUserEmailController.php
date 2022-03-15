<?php


namespace Src\UsersManagement\User\Infrastructure\Controllers;

use Src\Shared\Infrastructure\Response\ExceptionResponse;
use Src\Shared\Infrastructure\Response\MessageResponse;
use Src\UsersManagement\User\Application\UserEmailsCreator;
use Src\UsersManagement\User\Domain\UserRepositoryContract;
use Throwable;

class CreateUserEmailController
{
    private UserEmailsCreator $emailsCreator;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->emailsCreator = new UserEmailsCreator($repository);
    }


    /**
     * @param string $id
     * @param array<array<string,string>> $emails
     * @return ExceptionResponse|MessageResponse
     */
    public function __invoke(string $id, array $emails): ExceptionResponse|MessageResponse
    {
        try {
            $this->emailsCreator->execute($id, $emails);
            return new MessageResponse("Email creado correctamente.");

        } catch (Throwable $exception){
            return new ExceptionResponse($exception->getMessage(), $exception);
        }
    }
}
