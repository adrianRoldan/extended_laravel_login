<?php

namespace Src\UsersManagement\User\Infrastructure\Repositories;

use App\Models\User as EloquentUser;
use App\Models\UserEmailAlias as EloquentUserEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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

class EloquentUserRepository implements UserRepositoryContract
{

    private EloquentUser $eloquentUser;
    private EloquentUserEmail $eloquentUserEmail;

    private array $default_relations = ["emails"];  //Se aplica esta realacion de Eloquent por defecto al modelo $eloquentUser

    public function __construct(EloquentUser $eloquentUser, EloquentUserEmail $eloquentUserEmail )
    {
        $this->eloquentUser = $eloquentUser;    //User Model
        $this->eloquentUserEmail = $eloquentUserEmail;  //UserEmailAlias Model
    }


    /**
     * @param UserId $id
     * @param array $relations
     * @return User|null
     * @throws ValidationDomainException
     */
    public function find(UserId $id, array $relations = []): ?User
    {
        if(!$eloquentUser = $this->with($relations)->where("uuid", $id->value())->first())
            return null;

        return new User(
            $id,
            new UserName($eloquentUser->name),
            new UserPassword($eloquentUser->password),
            new UserEmails($eloquentUser->emails->toArray()),
            new UserAvatar($eloquentUser->avatar),
            new UserGoogleId($eloquentUser->google_id),
        );
    }


    /**
     * @param UserGoogleId $google_id
     * @param array $relations
     * @return User|null
     * @throws ValidationDomainException
     */
    public function findByGoogleId(UserGoogleId $google_id, array $relations = []): ?User
    {
        if(!$eloquentUser = $this->with($relations)->where("google_id", $google_id->value())->first())
            return null;

        return new User(
            new UserId($eloquentUser->uuid),
            new UserName($eloquentUser->name),
            new UserPassword($eloquentUser->password),
            new UserEmails($eloquentUser->emails->toArray()),
            new UserAvatar($eloquentUser->avatar),
            $google_id
        );
    }


    /**
     * @param User $user
     */
    public function save(User $user): void
    {
        $eloquentUser = $this->eloquentUser->create($user->toArray());
        $eloquentUser->emails()
            ->createMany($user->emails()->value());
    }


    /**
     * @param UserId $id
     */
    public function delete(UserId $id): void
    {
        $this->eloquentUser
            ->where('uuid', $id->value())
            ->firstOrFail()
            ->delete();
    }


    /**
     * @param array $relations
     * @return Builder[]|Collection
     */
    public function all(array $relations = [])
    {
        return $this->with($relations)->get();
    }


    /**
     * @param array $relations
     * @return Builder
     */
    private function with(array $relations = [])
    {
        if(!$relations)
            $relations = $this->default_relations;

        return $this->eloquentUser->with($relations);
    }


    /**
     * @param UserId $id
     * @param User $user
     */
    public function update(UserId $id, User $user): void
    {
        // TODO: Implement update() method.
    }



    /**
     * @param UserId $id
     * @return UserEmails
     */
    public function getEmailsByUser(UserId $id): UserEmails
    {
        $eloquentEmails = $this->eloquentUser
            ->where('uuid', $id->value())
            ->firstOrFail()
            ->emails;

        return new UserEmails($eloquentEmails->toArray());
    }

    /**
     * @return UserEmails
     * @throws ValidationDomainException
     */
    public function getEmails(): UserEmails
    {
        $emails = $this->eloquentUserEmail
            ->get()
            ->toArray();

        return new UserEmails($emails);
    }

    /**
     * @param UserId $user_id
     * @param UserEmails $new_emails
     */
    public function saveEmailsByUser(UserId $user_id, UserEmails $new_emails): void
    {
        $this->eloquentUser
            ->where('uuid', $user_id->value())
            ->firstOrFail()
            ->emails()
            ->createMany($new_emails->value());
    }


    /**
     * @param UserEmail $email
     * @return UserEmail|null
     */
    public function findEmail(UserEmail $email): ?UserEmail
    {
        if(!$this->eloquentUserEmail->where("email", $email->value())->first())
            return null;

        return $email;
    }


    /**
     * @param UserEmailId $id
     */
    public function deleteEmail(UserEmailId $id) : void
    {
        $this->eloquentUserEmail
            ->findOrFail($id->value())
            ->delete();
    }


    /**
     * @param UserEmailId $id
     * @param UserEmail $email
     */
    public function updateEmail(UserEmailId $id, UserEmail $email) : void
    {
        $this->eloquentUserEmail
            ->findOrFail($id->value())
            ->update(['email' => $email->value()]);
    }
}
