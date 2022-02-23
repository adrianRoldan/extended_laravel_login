<?php

namespace Src\UsersManagement\User\Domain;


use Src\UsersManagement\User\Domain\Entities\User;
use Src\UsersManagement\User\Domain\ValueObjects\UserEmail;
use Src\UsersManagement\User\Domain\ValueObjects\UserEmailId;
use Src\UsersManagement\User\Domain\ValueObjects\UserEmails;
use Src\UsersManagement\User\Domain\ValueObjects\UserGoogleId;
use Src\UsersManagement\User\Domain\ValueObjects\UserId;

interface UserRepositoryContract
{
    public function find(UserId $id): ?User;

    public function findByGoogleId(UserGoogleId $google_id, array $relations = []): ?User;

    public function save(User $user): void;

    public function delete(UserId $id): void;

    public function all(array $relations = []);

    public function update(UserId $id, User $user): void;

    public function getEmailsByUser(UserId $id): UserEmails;

    public function getEmails(): UserEmails;

    public function saveEmailsByUser(UserId $user_id, UserEmails $new_emails): void;

    public function findEmail(UserEmail $email): ?UserEmail;

    public function deleteEmail(UserEmailId $id) : void;

    public function updateEmail(UserEmailId $id, UserEmail $email) : void;
}
