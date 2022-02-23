<?php


namespace Src\UsersManagement\User\Application;


use Src\UsersManagement\User\Domain\UserRepositoryContract;

class UsedDomainsSearcher
{
    private UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->repository = $userRepository;
    }


    /**
     * @param int|null $maxDomains
     * @return array
     */
    public function execute(?int $maxDomains)
    {
        $emails = $this->repository->getEmails();

        $mostUsedDomains = [];
        foreach($emails->value() as $email){

            $domain = explode('@', $email['email'])[1]; //Obtenemos el dominio de la cuenta de correo

            if(!isset($mostUsedDomains[$domain]))
                $mostUsedDomains[$domain] = 1;  // Inicializamos el elemento "domain" del array
            else {
                $mostUsedDomains[$domain]++;    //Aumentamos contador del dominio
                arsort($mostUsedDomains);   //Ordenamos en cada iteración para mantener los más frecuentes al principio
            }
        }

        return array_slice($mostUsedDomains, 0, $maxDomains ?? 10);   //Retornamos solo los $maxDomains mas usados. por defecto 10
    }
}
