<?php


namespace Src\UsersManagement\User\Infrastructure\Repositories;


use Src\Shared\Domain\Exceptions\ValidationDomainException;
use Src\UsersManagement\User\Domain\Entities\User;
use Src\UsersManagement\User\Domain\UserRepositoryContract;
use Src\UsersManagement\User\Domain\ValueObjects\UserAvatar;
use Src\UsersManagement\User\Domain\ValueObjects\UserEmail;
use Src\UsersManagement\User\Domain\ValueObjects\UserEmailId;
use Src\UsersManagement\User\Domain\ValueObjects\UserEmails;
use Src\UsersManagement\User\Domain\ValueObjects\UserGoogleId;
use Src\UsersManagement\User\Domain\ValueObjects\UserId;
use Src\UsersManagement\User\Domain\ValueObjects\UserName;
use Src\UsersManagement\User\Domain\ValueObjects\UserPassword;


class InMemoryUserRepository implements UserRepositoryContract
{

    /**
     * @param UserId $id
     * @return User|null
     * @throws ValidationDomainException
     */
    public function find(UserId $id): ?User
    {
        if($id->value() == 2)
            return new User(
                $id,
                new UserName("Adrian"),
                new UserPassword("password"),
                new UserEmails(["email" => "adrian.roldan.90@gmail.com"]),
                new UserAvatar("profile.png"),
                new UserGoogleId("2345-3245234-12"),
            );

        return null;
    }

    public function save(User $user): void
    {
        // TODO: Implement save() method.
    }

    public function searchContactsByUser(UserId $id): array
    {
        // TODO: Implement searchContactsByUser() method.
    }

    public function saveContacts(UserId $id, Contact ...$contacts)
    {
        // TODO: Implement saveContacts() method.
    }

    public function deleteContacts(UserId $id)
    {
        // TODO: Implement deleteContacts() method.
    }

    public function update(UserId $id, User $user): void
    {
        // TODO: Implement update() method.
    }

    public function delete(UserId $id): void
    {
        // TODO: Implement delete() method.
    }

    public function findByGoogleId(UserGoogleId $google_id, array $relations = []): ?User
    {
        // TODO: Implement findByGoogleId() method.
    }

    public function all(array $relations = [])
    {
        // TODO: Implement all() method.
    }

    public function getEmailsByUser(UserId $id): UserEmails
    {
        // TODO: Implement getEmailsByUser() method.
    }

    public function getEmails(): UserEmails
    {
        // TODO: Implement getEmails() method.
    }

    public function saveEmailsByUser(UserId $user_id, UserEmails $new_emails): void
    {
        // TODO: Implement saveEmailsByUser() method.
    }

    public function findEmail(UserEmail $email): ?UserEmail
    {
        // TODO: Implement findEmail() method.
    }

    public function deleteEmail(UserEmailId $id): void
    {
        // TODO: Implement deleteEmail() method.
    }

    public function updateEmail(UserEmailId $id, UserEmail $email): void
    {
        // TODO: Implement updateEmail() method.
    }
}
