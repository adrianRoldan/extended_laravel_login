<?php

namespace Src\UsersManagement\User\Infrastructure\Controllers;

use Src\Shared\Infrastructure\Response\DataResponse;
use Src\Shared\Infrastructure\Response\ExceptionResponse;
use Src\UsersManagement\User\Application\UserEmailsSearcher;
use Src\UsersManagement\User\Domain\UserRepositoryContract;
use Throwable;

class GetUserEmailsController
{
    private UserEmailsSearcher $searcher;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->searcher = new UserEmailsSearcher($repository);
    }

    /**
     * @param string $user_id
     * @return DataResponse|ExceptionResponse
     */
    public function __invoke(string $user_id)
    {
        try {
            $data = $this->searcher->execute($user_id)->value();
            return new DataResponse("Emails de usuario cargados correctamente.", $data);

        } catch (Throwable $exception){
            return new ExceptionResponse($exception->getMessage(), $exception);
        }
    }
}
