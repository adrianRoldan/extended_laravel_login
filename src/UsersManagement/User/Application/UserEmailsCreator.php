<?php

namespace Src\UsersManagement\User\Application;

use Src\Shared\Domain\Exceptions\ValidationDomainException;
use Src\UsersManagement\User\Domain\Exceptions\UserEmailAlreadyExists;
use Src\UsersManagement\User\Domain\Exceptions\UserEmailNotFound;
use Src\UsersManagement\User\Domain\UserRepositoryContract;
use Src\UsersManagement\User\Domain\ValueObjects\UserEmails;
use Src\UsersManagement\User\Domain\ValueObjects\UserId;


class UserEmailsCreator
{
    private UserRepositoryContract $repository;
    private UserEmailFinder $emailFinder;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->repository = $userRepository;
        $this->emailFinder = new UserEmailFinder($userRepository);
    }


    /**
     * Este servicio inserta los $emails facilitados y los asigna al usuario $user_id
     *
     * @param string $user_id
     * @param array $emails
     * @throws UserEmailAlreadyExists
     * @throws ValidationDomainException
     */
    public function execute(string $user_id, array $emails)
    {
        $id = new UserId($user_id);
        $emails = new UserEmails($emails);

        //Comprobamos que los emails no estén ya registrados
        foreach($emails->value() as $email)
            $this->checkAlreadyExists($email['email']);

        $this->repository->saveEmailsByUser($id, $emails);
    }


    /**
     * @param string $email
     * @throws UserEmailAlreadyExists
     */
    private function checkAlreadyExists(string $email)
    {
        try {
            $userEmail = $this->emailFinder->execute($email);

            //Si llega aquí significa que ya existe ese email
            throw new UserEmailAlreadyExists($userEmail);

        }catch(UserEmailNotFound $e) {}

    }

}
