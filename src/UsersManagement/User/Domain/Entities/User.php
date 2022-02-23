<?php

namespace Src\UsersManagement\User\Domain\Entities;

use Src\UsersManagement\User\Domain\ValueObjects\UserAvatar;
use Src\UsersManagement\User\Domain\ValueObjects\UserEmails;
use Src\UsersManagement\User\Domain\ValueObjects\UserGoogleId;
use Src\UsersManagement\User\Domain\ValueObjects\UserId;
use Src\UsersManagement\User\Domain\ValueObjects\UserName;
use Src\Shared\Domain\Contracts\EntityContract;
use Src\UsersManagement\User\Domain\ValueObjects\UserPassword;

final class User implements EntityContract
{

    private UserId $id;
    private UserName $name;
    private UserPassword $password;
    private UserEmails $emails;
    private UserAvatar|null $avatar;
    private UserGoogleId|null  $google_id;

    public function __construct(
        Userid $id,
        UserName $name,
        UserPassword $password,
        UserEmails $emails,
        UserAvatar $avatar = null,
        UserGoogleId $google_id = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->avatar = $avatar;
        $this->google_id = $google_id;
        $this->password = $password;
        $this->emails = $emails;
    }

    /**
     * Genera una nueva instancia de la clase
     * @param UserId $id
     * @param UserName $name
     * @param UserPassword $password
     * @param UserEmails $emails
     * @param UserAvatar|null $avatar
     * @param UserGoogleId|null $google_id
     * @return User
     */
    public static function create(Userid $id, UserName $name, UserPassword $password, UserEmails $emails, UserAvatar $avatar = null, UserGoogleId $google_id = null) : User
    {
        //TODO: events
        return new self($id, $name, $password, $emails, $avatar, $google_id);
    }

    //Getters de los valueObjects de User
    public function id(): UserId
    {
        return $this->id;
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function avatar(): UserAvatar
    {
        return $this->avatar;
    }

    public function googleId(): UserGoogleId
    {
        return $this->google_id;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }

    public function emails(): UserEmails
    {
        return $this->emails;
    }


    /**
     * Transforma los valueObjects de la entidad User en array
     * @return array
     */
    public function toArray() : array
    {
        return [
            "uuid"      => $this->id->value(),
            "name"      => $this->name->value(),
            "password"  => $this->password->value(),
            "emails"    => $this->emails->value(),
            "avatar"    => $this->avatar->value(),
            "google_id" => $this->google_id->value()
        ];
    }
}
