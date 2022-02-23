<?php

namespace Src\UsersManagement\User\Infrastructure\Controllers;

use Src\Shared\Infrastructure\Response\DataResponse;
use Src\Shared\Infrastructure\Response\ExceptionResponse;
use Src\UsersManagement\User\Application\UsersSearcher;
use Src\UsersManagement\User\Domain\UserRepositoryContract;
use Throwable;

class GetUsersController
{
    private UsersSearcher $searcher;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->searcher = new UsersSearcher($repository);
    }

    /**
     * @return DataResponse|ExceptionResponse
     */
    public function __invoke()
    {
        try {
            $data = $this->searcher->execute();
            return new DataResponse("Usuarios cargados correctamente.", $data);

        } catch (Throwable $exception){
            return new ExceptionResponse("Error al obtener el listado de usuarios", $exception);
        }
    }
}
