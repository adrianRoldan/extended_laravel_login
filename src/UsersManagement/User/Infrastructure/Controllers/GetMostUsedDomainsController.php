<?php

namespace Src\UsersManagement\User\Infrastructure\Controllers;

use Src\Shared\Infrastructure\Response\DataResponse;
use Src\Shared\Infrastructure\Response\ExceptionResponse;
use Src\UsersManagement\User\Application\UsedDomainsSearcher;
use Src\UsersManagement\User\Domain\UserRepositoryContract;
use Throwable;

class GetMostUsedDomainsController
{

    private UsedDomainsSearcher $searcherDomains;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->searcherDomains = new UsedDomainsSearcher($repository);
    }

    /**
     * @param int|null $maxDomains
     * @return DataResponse|ExceptionResponse
     */
    public function __invoke(?int $maxDomains)
    {
        try {
            $data = $this->searcherDomains->execute($maxDomains);
            return new DataResponse("Dominios de correo mas usados.", $data);

        } catch (Throwable $exception){
            return new ExceptionResponse("Error al obtener el listado de usuarios", $exception);
        }
    }

}
